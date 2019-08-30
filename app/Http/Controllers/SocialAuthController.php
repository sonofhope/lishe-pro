<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    //redirect to social network to register or login
    public function redirect($social)
    {
        return Socialite::with($social)->redirect();
    }

    public function callback($social)
    {
        //fetch user from social network
        $auth_user = Socialite::with($social)->user();

        $account = User::whereProvider($social)->whereProviderId($auth_user->id)->first();
        $userEmailExists = User::whereEmail($auth_user->email)->first();

        //check if theres a user with the same email as the social account, but not registered with the social account
        if ($userEmailExists && !$account)
        {
            return redirect('/login')->with(['socialerror'=> 'The email for this social account has already been registered with another user!']);
        }
        elseif ($account)
        {
            //if the social account already exists then login the user
            $user = $account;
            Auth::login($user, true);
            return Redirect::to(Session::get('url.intended'))->with(['loginsuccess'=> 'Welcome ']);
        }
        else {
            //otherwise create a new social account and log the user in
            $fn = strtok($auth_user->name, " ");
            $ln = str_replace($fn, '', $auth_user->name);

            $user = User::create(
                [
                    'provider' => $social,
                    'provider_id' => $auth_user->id,
                    'email' => $auth_user->email,
                    'firstname' => $fn,
                    'lastname' => $ln,
                    'status' => 1
                ]
            );

            Auth::login($user, true);
            return redirect('/')->with(['loginsuccess'=> 'Welcome ']);
        }

    }
}
