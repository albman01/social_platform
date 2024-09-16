<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use Illuminate\Http\Request;

class MyController extends Controller
{
    public function triggerEvent()
    {
        // Dati da inviare con l'evento
        $data = ['message' => 'Hello from the controller!'];

        // Scatenare l'evento
        event(new MyEvent($data));

        // Risposta per confermare che l'evento è stato inviato
        return response()->json(['status' => 'Event triggered']);
    }
}

