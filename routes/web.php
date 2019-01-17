<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get("/", "BaseController@index");
Route::get("/login", "LoginController@index");
Route::post("/add-to-cart", "CartController@addToCart");
Route::get("/checkout", "CartController@checkOut");
Route::post("/cart-remove", "CartController@cartRemove");
Route::get("/load-address", "CartController@loadAddress");

Route::get("/purchase", "HomeController@purchase");
Route::post('/ipnpaypal', 'HomeController@ipnpaypal')->name('ipn.paypal');


$arr = array(
    "product-management" => "ProductController",
   // "category-management" => "CategoryController",
);
foreach ($arr as $key => $value) {
   Route::get("/{$key}", "{$value}@index");
   Route::get("/{$key}/create", "{$value}@create");
   Route::post("/{$key}", "{$value}@store");
   Route::get("/{$key}/edit/{id}", "{$value}@edit");
   Route::post("/{$key}/update", "{$value}@update");
   Route::get("/{$key}/delete/{id}", "{$value}@destroy");
}
Auth::routes();

Route::get("/home", "HomeController@index")->name("home");

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get("/account-management", "AdminController@index");
Route::get("/admin-report", "AdminController@report");


Route::get("/{slag1}/{slag2}", "BaseController@category");
Route::get("/{slag1}/{slag2}/{slag3}", "BaseController@subcategory");
Route::get("/{slag1}/{slag2}/{slag3}/{slag4}", "BaseController@details");