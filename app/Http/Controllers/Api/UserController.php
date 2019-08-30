<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Resources\User as UserRsource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($uid)
    {
        $user = User::find($uid);

        if($user)
        {
            return new UserRsource($user);
        }

        return response()->json('no such user',404);
    }

    public function index()
    {
        $user = User::all();
        return UserRsource::collection($user);
    }

    public function delete(User $uid)
    {
        if($uid->delete())
        {
            return response()->json('user deleted', 200);
        }
        else
        {
            return response()->json('failed to delete',400);
        }
    }

}
