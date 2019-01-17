<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct() {
      $this->middleware(function ($request, $next) {
         if (isset(Auth::user()->type)) {
            $type = Auth::user()->type;
            if ($type <= 2) {
               return redirect('/');
            }
            return $next($request);
         } else {
            return redirect('/');
         }
      });
   }
   
   public function index(){
      $arr = array();
      $arr['title'] = "Users Management | php.com";
      $arr['allData'] = parent::CallRaw("al", array());
      $arr['allUsers'] = DB::table("users")->get();

      return view("backend/users")->with($arr);
   }
   
   public function report(Request $request){
      $arr = array();
      $arr['title'] = "Report | php.com";
      $arr['allData'] = parent::CallRaw("al", array());
      $arr['allUsers'] = DB::table("users")->get();
      
      $req = $request->get("sub");
      if($req){
         $title = $request->get("title");
         $date1 = $request->get("date1");
         $date2 = $request->get("date2");
         $userid = $request->get("userid");
         $price1 = $request->get("price1");
         $price2 = $request->get("price2");
         
        $query = DB::table("sales as s")
                ->select("p.id", "p.title", "p.price", "u.name", "s.date")
                 ->join("sales_details as sd", "sd.sale_id", "=", "s.id")
                 ->join("products as p", "p.id", "=", "sd.product_id")
                ->join("shippings as sp", "sp.id", "=", "s.shipping_id")
                ->join("users as u", "u.id", "=", "sp.user_id");
        if($date1 && $date2){
           $query->where("s.date", ">=", $date1 . " 00:00:00");
           $query->where("s.date", "<=", $date2 . " 23:59:59");
        }
        else if($date1){
           $query->where("s.date", ">=", $date1 . " 00:00:00");
           $query->where("s.date", "<=", $date1 . " 23:59:59");
        }
        else if($date2){
           $query->where("s.date", ">=", $date2 . " 00:00:00");
           $query->where("s.date", "<=", $date2 . " 23:59:59");
        }
        
        if($price1 && $price2){
           $query->where("p.price", ">=", $price1);
           $query->where("p.price", "<=", $price2);
        }
        else if($price1){
           $query->where("p.price", "=", $price1);
        }
        else if($price2){
           $query->where("p.price", "=", $price2);
        }
        
        if($userid){
           $query->where("u.id", "=", $userid);
        }
        if($title){
           $query->where("p.title", "like", "%{$title}%");
        }
        $result = $query->get();
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        die();
      }
      
      return view("backend/report")->with($arr);
   }
}
