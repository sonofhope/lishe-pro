<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordRecoveryMail;

class RecoveryController extends Controller
{
    public function mailUser(Request $request)
    {
        $account = User::where('email', '=', $request['email'])->exists();

        //if theres a user with the email, send a password reset email
        if($account) {
            $user = User::whereEmail($request['email'])->first();
            try
            {
                $objUser = new \stdClass();
                $objUser->firstname = $user->firstname;
                $objUser->id = $user->id;

                Mail::to($request->email)->send(new PasswordRecoveryMail($objUser));
                return redirect('/login')->with(['mailsuccess'=> 'Check your email for a password reset link!']);
            }
            catch(\Throwable $e)
            {
                return $e->getMessage();
            }

        }
        else {
            return back()->withErrors([
                'message' => 'Your email is not registered with us!'
            ]);
        }
    }

    public function index($code)
    {
        //present user details in password reset page
        $id = base64_decode($code);
        $user = User::whereId($id)->first();

        return view('auth.reset')->with(['user' => $user]);
    }

    public function reset(ResetRequest $request)
    {
        try {
            //update password
            $newPass = bcrypt($request->password);
            User::whereId($request->invisible)->update(['password' => $newPass]);

            return redirect('/login')->with([
                'updatesuccess' => 'Your password has been reset, please login!'
            ]);
        }
        catch(\Throwable $e) {
            return $e->getMessage();
        }

    }
}
