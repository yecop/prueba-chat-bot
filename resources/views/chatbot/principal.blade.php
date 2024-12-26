<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot GPT</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="chat">
        <div id="chatbox">
            <div id="messages"></div>
        </div>
        <input type="text" id="userMessage" placeholder="Escribe tu mensaje..." />
        <button onclick="sendMessage()">Enviar</button>
    </div>

    <script>
        function sendMessage() {
            const userMessage = document.getElementById('userMessage').value;
            const messagesDiv = document.getElementById('messages');

            if (!userMessage.trim()) return;

            // Añadir mensaje del usuario al chat
            messagesDiv.innerHTML += `<p><strong>Tú:</strong> ${userMessage}</p>`;

            axios.post('/chatbot', { message: userMessage })
                .then(response => {
                    const botReply = response.data.reply;
                    messagesDiv.innerHTML += `<p><strong>ChatBot:</strong> ${botReply}</p>`;
                })
                .catch(error => {
                    messagesDiv.innerHTML += `<p><strong>Error:</strong> No se pudo obtener respuesta</p>`;
                });

            document.getElementById('userMessage').value = '';
        }
    </script>
</body>
</html>
