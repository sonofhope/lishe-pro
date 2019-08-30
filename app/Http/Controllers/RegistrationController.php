<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountVerificationMail;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show()
    {
        //get the register page together with the previous URL
        Session::put('url.intended',URL::previous());
        return view('auth.register');
    }

    public function create(RegistrationRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        $userEmailExists = User::whereEmail($request->email)->first();

        //chack if the registered user email is already existing
        if ($userEmailExists) {
            return redirect('/register')->with(['socialerror'=> 'The email for this account has already been registered with another user!']);
        }
        else {
            //if it doesn't exist, create a new user
            $user = User::create([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'email'=>$request->email,
                'password'=>$request->password,
                'status'=> 0
            ]);

            auth()->login($user);

            //send an account verification email
            $objUser = new \stdClass();
            $objUser->firstname = $request->firstname;
            $objUser->id = $user->id;

            try {
                Mail::to($request->email)->send(new AccountVerificationMail( $objUser));
                return Redirect::to(Session::get('url.intended'))->with(['regsuccess'=> 'Welcome to LishePro!']);
            }
            catch(\Throwable $e) {
                return $e->getMessage();
            }

        }
    }

}
