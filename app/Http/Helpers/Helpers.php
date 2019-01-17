<?php

function RandomString($num) {
   $arr = array_merge(range("A", "Z"), range("a", "z"), range(0, 9));
   $str = "";
   for ($i = 1; $i <= $num; $i++) {
      $str .= $arr[rand(0, count($arr) - 1)];
   }
   return $str;
}

function DateConverter($date) {
   $time = strtotime($date);
   return date("M d, Y", $time);
}

function discount($price, $dis){
  if($dis > 0){
    //$cal = $price - ($dis*$price)/100;
    return "<del>\${$price}</del>&nbsp;&nbsp;&nbsp;" . ($price - ($dis*$price)/100);
  }
  return "$" . $price;
}

function checkoutPrice($price, $dis, $qty){
   return ($price - ($dis*$price)/100) * $qty;
}

function pictureHelper($id, $ext1, $ext2, $ext3){
   if(file_exists("public/images/product/{$id}-1.{$ext1}")){
      return "public/images/product/{$id}-1.{$ext1}";
   }
   else if(file_exists("public/images/product/{$id}-2.{$ext2}")){
      return "public/images/product/{$id}-2.{$ext2}";
   }
   else if(file_exists("public/images/product/{$id}-3.{$ext3}")){
      return "public/images/product/{$id}-3.{$ext3}";
   }
   else{
      return "public/images/no-image.jpg";
   }
}
function pictureHelper2($id, $ext1, $ext2, $ext3, $ext4){
   if(file_exists("public/images/product/1" . md5($id) . ".{$ext1}")){
      return "public/images/product/1" . md5($id) . ".{$ext1}";
   }
   else if(file_exists("public/images/product/2" . md5($id) . ".{$ext2}")){
      return "public/images/product/2" . md5($id) . ".{$ext2}";
   }
   else if(file_exists("public/images/product/3" . md5($id) . ".{$ext3}")){
      return "public/images/product/3" . md5($id) . ".{$ext3}";
   }
   else if(file_exists("public/images/product/4" . md5($id) . ".{$ext4}")){
      return "public/images/product/4" . md5($id) . ".{$ext4}";
   }
}
function pictureSingle($id, $serial, $ext){
   if(file_exists("public/images/product/{$serial}" . md5($id) . ".{$ext}")){
      return "public/images/product/{$serial}" . md5($id) . ".{$ext}";
   }
   else{
      return "";
   }
}

function Replace($data) {
    $data = trim(str_replace("'", "", $data));
    $data = str_replace("/", "-", $data);
    $data = str_replace("!", "", $data);
    $data = str_replace("@", "", $data);
    $data = str_replace("#", "", $data);
    $data = str_replace("$", "", $data);
    $data = str_replace("%", "", $data);
    $data = str_replace("^", "", $data);
    $data = str_replace("&", "", $data);
    $data = str_replace("*", "", $data);
    $data = str_replace("(", "", $data);
    $data = str_replace(")", "", $data);
    $data = str_replace("+", "", $data);
    $data = str_replace("=", "", $data);
    $data = str_replace(",", "", $data);
    $data = str_replace(":", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("|", "", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace('"', "", $data);
    $data = str_replace("?", "", $data);
    $data = str_replace("  ", "_", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace(".", "-", $data);
    $data = strtolower(str_replace("  ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace("__", "-", $data));
    return str_replace("_", "-", $data);
}
