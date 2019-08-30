<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        //protect all methods with guest middleware except destroy and verify
        $this->middleware('guest')->except('destroy', 'verify');
    }

    public function show()
    {
        //return login page with the previous URL
        Session::put('url.intended',URL::previous());
        return view('auth.login');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with(['outsuccess'=> 'You have been logged out!']);
    }

    public function create(LoginRequest $request)
    {
        if (Auth::attempt(['email'=> $request->email, 'password'=> $request->password])) {

            //after loggin in redirect to the intended URL
            return Redirect::to(Session::get('url.intended'))->with(['loginsuccess'=> 'Welcome ']);
        }
        else {
            return back()->withErrors([
                'message' => 'Your login credentials are incorrect'
            ]);
        }

    }

    public function verify($code)
    {
        $id = base64_decode($code);
        $valid = User::whereId($id)->update(['status' => true]);

        if($valid)
        {
            auth()->logout();
            return redirect('/login')->with([
                'verified' => 'Your account has been verified!'
            ]);
        }
    }
}
