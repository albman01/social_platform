<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Mostra la pagina della chat con i messaggi.
     */
    public function index()
    {
        // Recupera i messaggi dal database
        $messages = Message::with('user')->latest()->get();

        // Passa i messaggi alla vista
        return view('chat', ['messages' => $messages]);
    }

    /**
     * Gestisce l'invio di un messaggio.
     */
    public function sendMessage(Request $request)
    {
        // Valida la richiesta
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Crea un nuovo messaggio
        $message = new Message();
        $message->body = $request->input('message');
        $message->user_id = Auth::id(); // Usa l'ID dell'utente autenticato
        $message->save();

        // Eventualmente, puoi usare un evento per broadcasting
        // broadcast(new MessageSent($message));

        // Restituisci una risposta JSON
        return response()->json(['status' => 'Message sent!']);
    }
}
