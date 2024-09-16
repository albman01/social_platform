<?php

use App\Events\MyEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\ChatController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/trigger-event', [MyController::class, 'triggerEvent']);


Route::get('/trigger-event', function () {
    // Dati da inviare con l'evento
    $data = ['message' => 'Hello from the route!'];

    // Scatenare l'evento
    event(new MyEvent($data));

    // Risposta per confermare che l'evento è stato inviato
    return 'Event triggered!';
});


Route::get('/', [ChatController::class, 'index']); // Imposta la pagina iniziale
Route::get('/chat', [ChatController::class, 'index']);
Route::post('/send-message', [ChatController::class, 'sendMessage']);


