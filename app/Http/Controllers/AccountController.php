<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index($id)
    {
        //give user object
        $user = User::whereId($id)->first();

        //limit access
        if($id != Auth::id())
        {
            abort(404, 'Sorry, you are not authorized!');
        }

        return view('account', compact('user'));
    }

    public function userdel($id)
    {
        //delete user
        $res = User::whereId($id)->delete();
        if($res)
        {
            return redirect('/')->with([
                'accdel' => 'Account deleted successfully!'
            ]);
        }
        else
        {
            return back()->with([
                'accfail' => 'Account could not be deleted!'
            ]);
        }
    }
}
