<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;

class CartController extends Controller {

   public function addToCart(Request $request) {
      $pid = $request->post("ids");
      $qty = $request->post("qty");
      $spdt = Session::get("pdtId");
      $sqty = Session::get("qtyId");

      if ($spdt) {
         $index = array_search($pid, $spdt);
         if ($index !== FALSE) {
            $sqty[$index] = $qty;
            $msg = "Update successfully";
         } else {
            $spdt[] = $pid;
            $sqty[] = $qty;
            $msg = "Add successfully";
         }
      } else {
         $spdt[] = $pid;
         $sqty[] = $qty;
         $msg = "Add successfully";
      }


      Session::put("pdtId", $spdt);
      Session::put("qtyId", $sqty);
      echo $msg;
   }

   public function checkOut() {
      $arr = array();
      $spdt = Session::get("pdtId");
      $sqty = Session::get("qtyId");
      if (!$spdt) {
         return redirect("/");
      }

      $arr['allPdt'] = DB::table("products")->whereIn("id", $spdt)->get();
      $arr['allData'] = parent::CallRaw("checkout", array());
      return view("checkout")->with($arr);
   }

   public function cartRemove(Request $request) {
      $ids = $request->post("ids");
      $spdt = Session::get("pdtId");
      $sqty = Session::get("qtyId");

      $index = array_search($ids, $spdt);
      if ($index !== FALSE) {
         if (count($spdt) > 1) {
            unset($spdt[$index]);
            unset($sqty[$index]);

            Session::put("pdtId", $spdt);
            Session::put("qtyId", $sqty);
            return redirect("/checkout");
         } else {
            Session::flash("pdtId");
            Session::flash("qtyId");
            return redirect("/");
         }
      } else {
         return redirect("/");
      }
   }
   
   public function loadAddress(){
      $html = "";
      $data = DB::table("shippings")->where("user_id", "=", Auth::user()->id)->get();
      if($data){
         foreach ($data as $value){
            $html .= "<div class='address' id='{$value->id}'>";
            $html .= "<h4>{$value->fullname}</h4>";
            $html .= "<p>{$value->address}</p>";
            $html .= "<p>Contact: {$value->contact}</p>";
            $html .= "</div>";
         }
      }
      else{
         $html .= "No Address Found";
      }
      echo $html;
   }

}
