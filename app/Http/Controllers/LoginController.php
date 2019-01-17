<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        $arr = array();
        $arr['title'] = "Login | php.com";
        return view("login")->with($arr);
    }
}
