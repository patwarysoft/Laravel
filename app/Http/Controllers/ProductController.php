<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class ProductController extends Controller {

   public function __construct() {
      $this->middleware(function ($request, $next) {
         if (isset(Auth::user()->type)) {
            $type = Auth::user()->type;
            if ($type <= 1) {
               return redirect('/');
            }
            return $next($request);
         } else {
            return redirect('/');
         }
      });
   }

   protected function index() {
      $arr = array();
      $arr['title'] = "Home Page | php.com";
      $arr['allPdt'] = DB::table("products as p")
              ->select("p.id", "p.title", "p.price", "p.discount", "p.stock", "c.name as cname", "sc.name as scname", "u.name as uname")
              ->join("units as u", "u.id", "=", "p.unti_id")
              ->join("subcategories as sc", "sc.id", "=", "p.subcategory_id")
              ->join("categories as c", "c.id", "=", "sc.category_id")
              ->get();

      return view("backend/product")->with($arr);
   }

   protected function create() {
      $arr = array();
      $arr['tinymce'] = 1;
      $arr['title'] = "Product Management Page | php.com";
      return view("backend/product-new")->with($arr);
   }

   protected function store(Request $request) {
      $validatedData = $request->validate([
          'title' => 'required|max:50',
          'price' => 'required|numeric|min:1',
          'stock' => 'required|numeric|min:1',
      ]);

      $ext1 = $ext2 = $ext3 = "";
      if ($request->file('picture1')) {
         $ext1 = strtolower($request->file('picture1')->getClientOriginalExtension());
      }
      if ($request->file('picture2')) {
         $ext2 = strtolower($request->file('picture2')->getClientOriginalExtension());
      }
      if ($request->file('picture3')) {
         $ext3 = strtolower($request->file('picture3')->getClientOriginalExtension());
      }

      $data = array(
          "title" => $request->post("title"),
          "price" => $request->post("price"),
          "stock" => $request->post("stock"),
          "discount" => $request->post("discount"),
          "unti_id" => 1,
          "subcategory_id" => 1,
          "picture1" => $ext1,
          "picture2" => $ext2,
          "picture3" => $ext3
      );

      $id = DB::table("products")->insertGetId($data);

      if ($id) {
         if ($request->file('picture1')) {
            $request->file('picture1')->move("public/images/product/", "{$id}-1.{$ext1}");
         }
         if ($request->file('picture2')) {
            $request->file('picture2')->move("public/images/product/", "{$id}-2.{$ext2}");
         }
         if ($request->file('picture3')) {
            $request->file('picture3')->move("public/images/product/", "{$id}-3.{$ext3}");
         }
         Storage::put("product/{$id}.txt", $request->post("description"));
      }

      return redirect("/product-management")->with("msg", "Insert Successfully");
   }

   public function edit($id) {
      $arr = array();
      $arr['tinymce'] = 1;
      $arr['title'] = "Product Management Page | php.com";
      $arr['pdt'] = DB::table("products")->where("id", "=", $id)->first();

      return view("backend/product-edit")->with($arr);
   }

   public function update(Request $request) {
      $id = $request->input("id");
      $pdt = DB::table("products")
                      ->select("*")
                      ->where("id", "=", $id)->first();


      if ($request->file('picture1')) {
         $ext1 = strtolower($request->file('picture1')->getClientOriginalExtension());
         if ($ext1 != "jpg" && $ext1 != "jpeg" && $ext1 != "png" && $ext1 != "gif") {
            $ext1 = $pdt->picture1;
         } else {
            if (file_exists("public/images/product/{$pdt->id}-1.{$pdt->picture1}")) {
               unlink("public/images/product/{$pdt->id}-1.{$pdt->picture1}");
            }
            $request->file('picture1')->move("public/images/product/", "{$pdt->id}-1.{$ext1}");
         }
      } else {
         $ext1 = $pdt->picture1;
      }

      if ($request->file('picture2')) {
         $ext2 = strtolower($request->file('picture2')->getClientOriginalExtension());
         if ($ext2 != "jpg" && $ext2 != "jpeg" && $ext2 != "png" && $ext2 != "gif") {
            $ext2 = $pdt->picture2;
         } else {
            if (file_exists("public/images/product/{$pdt->id}-1.{$pdt->picture2}")) {
               unlink("public/images/product/{$pdt->id}-1.{$pdt->picture2}");
            }
            $request->file('picture2')->move("public/images/product/", "{$pdt->id}-1.{$ext2}");
         }
      } else {
         $ext2 = $pdt->picture2;
      }


      if ($request->file('picture3')) {
         $ext3 = strtolower($request->file('picture3')->getClientOriginalExtension());
         if ($ext3 != "jpg" && $ext3 != "jpeg" && $ext3 != "png" && $ext3 != "gif") {
            $ext3 = $pdt->picture3;
         } else {
            if (file_exists("public/images/product/{$pdt->id}-1.{$pdt->picture3}")) {
               unlink("public/images/product/{$pdt->id}-1.{$pdt->picture3}");
            }
            $request->file('picture3')->move("public/images/product/", "{$pdt->id}-1.{$ext3}");
         }
      } else {
         $ext3 = $pdt->picture3;
      }

      $data = array(
          "title" => $request->post("title"),
          "price" => $request->post("price"),
          "stock" => $request->post("stock"),
          "discount" => $request->post("discount"),
          "unti_id" => 1,
          "subcategory_id" => 1,
          "picture1" => $ext1,
          "picture2" => $ext2,
          "picture3" => $ext3
      );

      DB::table("products")->where("id", "=", $pdt->id)->update($data);
      if (file_exists("app/product/{$pdt->id}.txt")) {
         unlink("app/product/{$pdt->id}.txt");
      }
      Storage::put("product/{$id}.txt", $request->post("description"));
      return redirect("/product-management")->with("msg", "Update Successfully");
   }

   protected function destroy($id) {
      $pdt = DB::table("products")
                      ->select("*")
                      ->where("id", "=", $id)->first();

      if (file_exists("public/images/product/{$pdt->id}-1.{$pdt->picture1}")) {
         unlink("public/images/product/{$pdt->id}-1.{$pdt->picture1}");
      }
      if (file_exists("public/images/product/{$pdt->id}-2.{$pdt->picture2}")) {
         unlink("public/images/product/{$pdt->id}-2.{$pdt->picture2}");
      }
      if (file_exists("public/images/product/{$pdt->id}-3.{$pdt->picture3}")) {
         unlink("public/images/product/{$pdt->id}-3.{$pdt->picture3}");
      }
      if (file_exists("app/product/{$pdt->id}.txt")) {
         unlink("app/product/{$pdt->id}.txt");
      }

      DB::table("products")->where("id", "=", $pdt->id)->delete();
      return redirect("/product-management")->with("msg", "Delete Successfully");
   }

}
