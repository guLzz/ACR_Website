<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;

//use Illuminate\Http\Request;
//use Socialite;

class SocialAuthFacebookController extends Controller
{
  /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        //return $userSocial->name;
        $findUser = User::where('email',$userSocial->email)->first();
        
        if ($findUser) 
        {
            Auth::login($findUser);
            return 'old user';//debug
        }
        else
        {
            $user = new User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(123456);
            $user->save();
            Auth::login($user);
            return ('new user');//debug
        }                
    }

}