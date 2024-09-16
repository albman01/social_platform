<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the broadcast channels that your application
| supports. The given channel authorization callbacks are used to check
| if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});


Broadcast::channel('my-channel', function ($user) {
    return true; // Permette a tutti di ascoltare il canale
});
