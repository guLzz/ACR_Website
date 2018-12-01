<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {
       
    }
    
    public function redirectToProvider($social)
    {
      Socialite::driver($social)->redirect();
    }
    public function handleProviderCallback($social)
    {
     $user = Socialite::driver($social)->user();
    }

}