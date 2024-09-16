<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style>
        /* Aggiungi il tuo stile per la chat qui */
        .chat-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .messages {
            border: 1px solid #ddd;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
        }
        .message-input {
            display: flex;
            margin-top: 10px;
        }
        .message-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .message-input button {
            padding: 10px;
            border: 1px solid #ddd;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="messages" id="messages">
            <!-- I messaggi verranno visualizzati qui -->
        </div>
        <div class="message-input">
            <input type="text" id="message" placeholder="Scrivi un messaggio...">
            <button onclick="sendMessage()">Invia</button>
        </div>
    </div>

    <script>
        import Echo from 'laravel-echo';
        import Pusher from 'pusher-js';

        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY,
            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            encrypted: true
        });

        window.Echo.channel('my-channel')
            .listen('.my-event', (event) => {
                const messages = document.getElementById('messages');
                const messageElement = document.createElement('div');
                messageElement.textContent = event.message;
                messages.appendChild(messageElement);
                messages.scrollTop = messages.scrollHeight;
            });

        function sendMessage() {
            const messageInput = document.getElementById('message');
            const message = messageInput.value;

            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ message })
            }).then(response => response.json())
              .then(data => {
                  messageInput.value = '';
              });
        }
    </script>
</body>
</html>
