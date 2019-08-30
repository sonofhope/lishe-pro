<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

/*Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});*/

Broadcast::channel('notification {id}', function ($user, $id){
    return (int) $user->id === (int) DB::select('select notifiable_id from notifications where id = ?', [$id]);
});
