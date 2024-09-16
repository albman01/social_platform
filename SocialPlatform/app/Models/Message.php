<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'recipient_id',
        'body',
    ];

    /**
     * Relazione con l'utente che ha inviato il messaggio.
     * Un messaggio appartiene a un mittente (utente).
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relazione con l'utente che ha ricevuto il messaggio.
     * Un messaggio appartiene a un destinatario (utente).
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
