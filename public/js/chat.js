document.addEventListener('DOMContentLoaded', () => {
    const messageElements = document.querySelectorAll('[id="messageOutput"]');
    const sendMessageForms = document.querySelectorAll('[id="chatForm"]');

    sendMessageForms.forEach((form) => {
        const userMessageInput = form.querySelector('[id="message"]');

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const messageContent = userMessageInput.value.trim();

            if (messageContent !== '') {
                userMessageInput.value = '';

                // Substitua os valores abaixo de acordo com a autenticação e validação adequadas do lado do servidor
                axios.post('/api/messages', {
                    message: messageContent,
                    username: window.username,
                    role: window.role,
                });
                // O tratamento das mensagens recebidas ocorrerá via Echo, não aqui.
            }
        });
    });

    window.Echo.channel('chat')
        .listen('.chatting', (data) => {
            // Assegure-se de que 'data' inclua 'username', 'role' e 'message'.
            appendMessage(data.username, data.role, data.message);
        });

    function appendMessage(username, role, message) {
        let messageHtml;
        switch(role) {
            case 'admin':
                messageHtml = createMessageHtml('fas fa-crown', 'text-red-600', 'text-white font-bold', username, message);
                break;
            case 'suporte':
                messageHtml = createMessageHtml('fa-solid fa-shield-halved', 'text-yellow-500', 'text-white font-bold', username, message);
                break;
            case 'shark':
                messageHtml = createImageMessageHtml('/images/shark.png', 'text-emerald-600', 'text-gray-300', username, message);
                break;
            case 'lion':
                messageHtml = createImageMessageHtml('/images/lion.png', 'text-orange-600', 'text-gray-300', username, message);
                break;
            case 'bear':
                messageHtml = createImageMessageHtml('/images/bear.png', 'text-blue-600', 'text-gray-400', username, message);
                break;
            default:
                messageHtml = createMessageHtml('', 'text-gray-600', 'text-gray-400', username, message, false);
                break;
        }

        messageElements.forEach(element => {
            element.innerHTML += messageHtml;
        });
    }

    function createMessageHtml(iconClass, usernameClass, messageClass, username, message) {
        return `
            <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full">
                <div class="flex items-center">
                    ${iconClass ? `<i class="${iconClass} text-white mr-2"></i>` : ''}
                    <span class="text-lg font-bold ${usernameClass}">${username}</span>
                </div>
                <p class="text-sm mt-1 ${messageClass}">${message}</p>
            </div>`;
    }

    function createImageMessageHtml(imageSrc, usernameClass, messageClass, username, message) {
        return `
            <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full">
                <div class="flex items-center">
                    <img src="${imageSrc}" class="size-7 mr-2">
                    <span class="text-lg font-bold ${usernameClass}">${username}</span>
                </div>
                <p class="text-sm mt-1 ${messageClass}">${message}</p>
            </div>`;
    }
});
