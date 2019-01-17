<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Lib\coinPayments;
use CoinGate\CoinGate;
use App\Lib\BlockIo;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller {

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct() {
      $this->middleware('auth');
      date_default_timezone_set("Asia/Dhaka");
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function index() {
      return view('home');
   }

   public function purchase(Request $request) {
      $addr_type = $request->post("addr_type");
      if($addr_type == 1) {
         $shipping = array(
             "fullname" => $request->fn,
             "address" => $request->addr,
             "contact" => $request->contact,
             "user_id" => Auth::user()->id
         );
         $sid = DB::table("shippings")->insertGetId($shipping); 
      }
      else{
         $sid = $request->post("shipping_id");
      }

      $sales = array(
          "status" => 0,
          "shipping_id" => $sid,
          "date" => date("Y-m-d H:i:s"),
          "token" => time() . rand(1111, 9999)
      );
      $salesid = DB::table("sales")->insertGetId($sales);

      $spdt = Session::get("pdtId");
      $sqty = Session::get("qtyId");
      $total = 0;

      foreach ($spdt as $key => $value) {
         $pdt = DB::table("products")->where("id", "=", $value)->first();
         $total += checkoutPrice($pdt->price, $pdt->discount, $sqty[$key]);
         $salesDetails = array(
             "sale_id" => $salesid,
             "product_id" => $value,
             "quantity" => $sqty[$key],
             "price" => $pdt->price,
             "discount" => $pdt->discount
         );
         DB::table("sales_details")->insert($salesDetails);
      }

      $data = array(
          "amount" => $total,
          "account" => "rokon2018@example.com",
          "track" => $sales['token']
      );
      return view('paypal')->with($data);
   }

   public function ipnpaypal() {

      $raw_post_data = file_get_contents('php://input');
      $raw_post_array = explode('&', $raw_post_data);
      $myPost = array();
      foreach ($raw_post_array as $keyval) {
         $keyval = explode('=', $keyval);
         if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
      }

      $req = 'cmd=_notify-validate';
      if (function_exists('get_magic_quotes_gpc')) {
         $get_magic_quotes_exists = true;
      }
      foreach ($myPost as $key => $value) {
         if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
         } else {
            $value = urlencode($value);
         }
         $req .= "&$key=$value";
      }



      $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
      //$paypalURL = "https://secure.paypal.com/cgi-bin/webscr";
      $ch = curl_init($paypalURL);
      if ($ch == FALSE) {
         return FALSE;
      }

      curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
      curl_setopt($ch, CURLOPT_SSLVERSION, 6);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
      curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
      $res = curl_exec($ch);
      $tokens = explode("\r\n\r\n", trim($res));
      $res = trim(end($tokens));

      //if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
      $receiver_email = $_POST['receiver_email'];
      $mc_currency = $_POST['mc_currency'];
      $mc_gross = $_POST['mc_gross'];
      $track = $_POST['custom'];


      $pm = DB::table("sales")->where("token", "=", $track)->first();
      
      if ($receiver_email == "rokon2018@example.com" && $mc_currency == "USD" && $pm->status == 0) {
         //mail('hasancse016@gmail.com', 'Payment Receive From Hockey Gear Shop', 'Amount Receive: ' . $pm->amount);

         DB::table("sales")
                 ->where("id", "=", $pm->id)
                 ->update(array("status" => 1));
      }
   }

}
