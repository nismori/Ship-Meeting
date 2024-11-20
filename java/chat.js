document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const messageInput = document.getElementById('message');
    const messageText = messageInput.value;

    if (messageText.trim() !== '') {
        // Crée un conteneur pour le message
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('message', 'sent'); 

        // Crée la bulle de message
        const messageContent = document.createElement('div');
        messageContent.classList.add('message-content');
        messageContent.textContent = messageText;

        // Ajoute la bulle au conteneur
        messageContainer.appendChild(messageContent);

        // Ajoute le message à la liste des messages
        document.getElementById('chat-messages').appendChild(messageContainer);

        // Efface le champ de saisie
        messageInput.value = '';

        // Fait défiler la liste des messages jusqu'en bas
        document.getElementById('chat-messages').scrollTop = document.getElementById('chat-messages').scrollHeight;

        // Envoyer le message au serveur via AJAX
        fetch('send_messages.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `message=${encodeURIComponent(messageText)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Pour le débogage
        })
        .catch(error => console.error('Error:', error));
    }
});