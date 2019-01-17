<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use home;

class LoginController extends Controller {
   /*
     |--------------------------------------------------------------------------
     | Login Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles authenticating users for the application and
     | redirecting them to your home screen. The controller uses a trait
     | to conveniently provide its functionality to your applications.
     |
    */

use AuthenticatesUsers;

   /**
    * Where to redirect users after login.
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
      $this->middleware('guest')->except('logout');
   }

   public function redirectToProvider() {
      return Socialite::driver('facebook')->redirect();
   }

   public function handleProviderCallback() {
      try {
         $user = Socialite::driver('facebook')->user();
      } catch (Exception $e) {
         return redirect('/login');
      }
      $authUser = $this->findOrCreateUser($user);
      Auth::login($authUser, true);
      return redirect('/');
   }

   public function findOrCreateUser($facebookUser) {
      $authUser = User::where('provider', $facebookUser->id)->first();
      if ($authUser) {
         return $authUser;
      }

      $authUser = User::where('email', $facebookUser->email)->first();
      if ($authUser) {
         User::where([
           "email" => $facebookUser->email  
         ])
         ->update([
                  'provider' => $facebookUser->id
         ]);
         return $authUser;
      }

      return User::create([
                  'name' => $facebookUser->name,
                  'email' => $facebookUser->email,
                  'city_id' => 1,
                  'provider' => $facebookUser->id
      ]);
   }

}
