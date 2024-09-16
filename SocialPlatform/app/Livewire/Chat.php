<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $messages;
    public $messageBody;
    public $recipientId;

    public function mount($recipientId)
    {
        $this->recipientId = $recipientId;
        $this->messages = Message::where(function($query) {
                $query->where('user_id', Auth::id())
                      ->where('recipient_id', $this->recipientId);
            })
            ->orWhere(function($query) {
                $query->where('user_id', $this->recipientId)
                      ->where('recipient_id', Auth::id());
            })
            ->get();
    }

    public function sendMessage()
    {
        $message = Message::create([
            'user_id' => Auth::id(),
            'recipient_id' => $this->recipientId,
            'body' => $this->messageBody,
        ]);

        $this->messages->push($message);
        $this->messageBody = ''; // Resetta il campo di input
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
