<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;


class BaseController extends Controller {

  public function index() {
     /*
      * 
       SELECT p.id, p.title, p.price, p.discount, p.picture1, p.picture2, p.picture3, c.name cname, sc.name scname, u.name uname, (SELECT sum(sales_details.quantity)
FROM sales_details where sales_details.product_id = p.id) total
FROM products p, categories c, subcategories sc, units u
where p.Subcategory_id = sc.id and
sc.Category_id = c.id AND
p.Unti_id = u.id
order by total DESC
LIMIT 12;
      
SELECT products.id, products.title, products.price,
(SELECT sum(sales_details.quantity)
FROM sales_details
where sales_details.product_id = products.id) total
FROM products
ORDER by total desc
limit 12;  
       
      */
    $arr = array();
    $arr['title'] = "Home Page | php.com";
    $arr['masud'] = Product::paginate(3);
    $arr['allData'] = parent::CallRaw("home", array());
    return view("intro")->with($arr);
  }

  public function about() {
    $arr = array();
    $arr['title'] = "About Us | php.com";
    return view("about_us_page")->with($arr);
  }
  
  public function category($slug1, $slug2){
     $arr = array();
    $arr['title'] = "Details | php.com";
    $arr['allData'] = parent::CallRaw("category", array($slug2));
    
    echo "<pre>";
    print_r( $arr['allData']);
    echo "</pre>";
  }
   public function subcategory($slug1, $slug2, $slug3){
    echo $slug3;
  }

  public function details($slug1, $slug2, $slug3) {
    $arr = array();
    $arr['title'] = "Details | php.com";
    $arr['allData'] = parent::CallRaw("details", array($slug3));
    foreach ($arr['allData'][2] as $value){
       $scid = $value->scid;
       $pid = $value->id;
    }
    $arr['relPdt'] = DB::table("products")
                     ->where("subcategory_id", "=", $scid)
                     ->where("id", "!=", $pid)
                     ->inRandomOrder()
                     ->paginate(5);
    
    echo "<pre>";
    print_r($arr['relPdt'] );
    echo "</pre>";
    return view("details")->with($arr);
  }

}
