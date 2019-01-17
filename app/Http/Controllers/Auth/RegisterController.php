<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
   /*
     |--------------------------------------------------------------------------
     | Register Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles the registration of new users as well as their
     | validation and creation. By default this controller uses a trait to
     | provide this functionality without requiring any additional code.
     |
    */

use RegistersUsers;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = '/home';

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct() {
      $this->middleware('guest');
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data) {
      return Validator::make($data, [
                  'name' => 'required|string|max:100',
                  'email' => 'required|string|email|max:100|unique:users,email',
                  'password' => 'required|string|min:6|confirmed',
                  'address' => 'required',
                  'cntid' => 'required|numeric|min:1',
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
   protected function create(array $data) {
      $status = rand(100000, 999999);
      $headers = "From: admin@hockeygearshop.com\r\n";
      $headers .= "Reply-To: info@hockeygearshop.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      $message = "<table width='100%' bgcolor='#eee' border='0' cellpadding='0' cellspacing='0' style='background-color:#eee'>
   <tbody><tr><td style='height:20px'></td></tr>
      <tr>
         <td>
            <table class='m_6157407039185654857content' align='center' bgcolor='#ffffff' cellpadding='0' cellspacing='0' border='0' style='border-radius:0px 0px 30px 30px'>
               <tbody>
                  <tr>
                     <td style='width:100%;height:20px;background-color:#003D7D; border-radius: 5px 5px 0 0'></td>
                  </tr>
                  <tr>
                     <td>
                        <table class='m_6157407039185654857hey' align='left' cellpadding='0' cellspacing='0' border='0'>
                           <tbody><tr><td style='height:25px'></td></tr>
                              <tr>
                                 <td style='width:20px'></td>
                                 <td style='font-size:30px;color:#ffffff'>
                                    <a href='http://www.hockeygearshop.com' target='_blank'><img src='https://thumb.ibb.co/eCdfUy/logo.png' alt='logo' border='0' width='100'></a>
                                 </td>
                              </tr>
                           </tbody></table>
                     </td>
                  </tr>
                  <tr>
                     <td style='width:100%;height:20px'></td>
                  </tr>
                  <tr>
                     <td>
                        <table cellpadding='0' cellspacing='0' border='0'>
                           <tbody><tr>
                                 <td style='width:20px'></td>
                                 <td>
                                    <table class='m_6157407039185654857message' align='left' width='100%' bgcolor='#ffffff' cellpadding='0' cellspacing='0' border='0' style='border-radius:10px 10px 10px 10px'>
                                       <tbody><tr>
                                             <td>
                                                <table class='m_6157407039185654857message-content' align='left' cellpadding='0' cellspacing='0' border='0'>
                                                   <tbody><tr><td style='height:20px'></td></tr>
                                                      <tr>
                                                         <td style='width:40px'></td>
                                                         <td style='width:540px;max-width:540px'>                                             
                                                            <p>Hi,</p>
                                                            <p>Your Hockey Gear Shop account created successfully.</p>
                                                            <p>To activate your account, <a href=\"http://www.hockeygearshop.com/account-verification?code={$status}\">Click Here</a></p>                                                           
                                                            <p>Thank you for using Hockey Gear Shop!</p>                                                            
                                                         </td>
                                                         <td style='width:40px'></td>
                                                      </tr>
                                                      <tr><td style='height:20px'></td></tr>
                                                   </tbody></table>
                                             </td>
                                          </tr>
                                          <tr><td style='height:20px'></td></tr>
                                       </tbody></table>
                                 </td>
                                 <td style='width:20px'></td>
                              </tr>
                           </tbody></table>
                     </td>
                  </tr>
                   <tr>
                     <td style='width:100%;height:20px;background-color:#003D7D;  border-radius: 0 0 5px 5px'></td>
                  </tr>
               </tbody></table>

         </td>
      </tr>
      <tr><td style='height:20px'></td></tr>
   </tbody></table>";
      //mail($data['email'], "Please activate your Hockey Gear Shop account", $message, $headers);
      return User::create([
                  'name' => $data['name'],
                  'email' => $data['email'],
                  'password' => bcrypt($data['password']),
                  'address' => $data['address'],
                  'city_id' => $data['city_id'],
                  'status' => $status,
      ]);
   }

}
