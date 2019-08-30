<?php

namespace App\Http\Controllers\Api;

use App\Mail\AccountVerificationMail;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'firstname'=> 'required',
            'lastname'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required|confirmed',
        ]);

        $userEmailExists = User::whereEmail($request->email)->first();

        if ($userEmailExists)
        {
            return response()->json('user exists', 202);
        }
        else
        {
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = false;
            $user->save();

            //send account verification email
            $objUser = new \stdClass();
            $objUser->firstname = $request->firstname;
            $objUser->id = $user->id;
            Mail::to($request->email)->send(new AccountVerificationMail( $objUser));

            //give a token
            $http = new Client();

            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 1,
                    'client_secret' => 'Z54g5QkhgieViyzQx1TzmNPmza7kvyncYAo2asGg',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);

            return response(['data' =>json_decode((string) $response->getBody(), true)]);

        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!$user)
        {
            return response([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }
        else
        {
            if(Hash::check($request->password, $user->password))
            {
                $http = new Client();
                $response = $http->post(url('oauth/token'), [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => 1,
                        'client_secret' => 'Z54g5QkhgieViyzQx1TzmNPmza7kvyncYAo2asGg',
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '',
                    ],
                ]);

                return response(['data' =>json_decode((string) $response->getBody(), true)]);
            }
            else
            {
                return response([
                    'status' => 'error',
                    'message' => 'Email and or Password do not match'
                ]);
            }
        }
    }

    public function logout()
    {
        //revoke access token

    }
}
