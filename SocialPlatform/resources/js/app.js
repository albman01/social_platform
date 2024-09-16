import './bootstrap';

import './echo'; 


document.addEventListener('DOMContentLoaded', function () {
    // Supponiamo che tu abbia l'ID dell'utente memorizzato in una variabile JavaScript
    let userId = window.Laravel.userId; // O recupera l'ID dell'utente in altro modo

    window.Echo.channel('chat.' + userId)
        .listen('.message.sent', (event) => {
            console.log('Message received:', event.message);
            // Aggiorna l'interfaccia utente con il nuovo messaggio
            updateChatInterface(event.message);
        });
});

function updateChatInterface(message) {
    // Funzione per aggiornare l'interfaccia utente con il nuovo messaggio
    // Aggiungi il messaggio al DOM, aggiornando la chat visivamente
}


document.addEventListener('DOMContentLoaded', function () {
    window.Echo.channel('my-channel')
        .listen('.my-event', (event) => {
            console.log('Event received:', event.data);
            alert('Event received: ' + JSON.stringify(event.data));
        });
});
