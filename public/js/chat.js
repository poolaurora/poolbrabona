document.addEventListener('DOMContentLoaded', () => {
    const messageElements = document.querySelectorAll('[id="messageOutput"]');
    const sendMessageForms = document.querySelectorAll('[id="chatForm"]');

    sendMessageForms.forEach((form) => {
        const userMessageInput = form.querySelector('[id="message"]');

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const messageContent = userMessageInput.value.trim();
        
            if (messageContent !== '') {
                // Limpa o campo de mensagem independentemente do resultado da requisição.
                userMessageInput.value = '';
        
                axios.post('/api/messages', {
                    message: messageContent,
                    username: window.username,
                    role: window.role,
                }).catch(error => {
                    // Verifica a estrutura do erro e exibe a mensagem de erro.
                    if (error.response && error.response.data && error.response.data.error) {
                        // Exibe a mensagem de erro apenas para o usuário que tentou enviar a mensagem.
                        appendMessage(window.username, window.role, error.response.data.error, true);
                    }
                });
            }
        });        
    });

    window.Echo.channel('chat')
        .listen('.chatting', (data) => {
            appendMessage(data.username, data.role, data.message);
        });

        function appendMessage(username, role, message, isError = false) {
            let messageHtml;
            if (isError) {
                messageHtml = `
                    <div class="px-4 py-2 bg-gray-800 rounded mb-3 w-full">
                        <p class="text-sm mt-1 text-red-500">${message}</p>
                    </div>`;
            } else {
                switch(role) {
                    case 'admin':
                        messageHtml = createMessageHtml('fas fa-crown', 'text-red-600', 'text-white font-bold', username, message);
                        break;
                    case 'suporte':
                        messageHtml = createMessageHtml('fa-solid fa-shield-halved', 'text-yellow-500', 'text-white font-bold', username, message);
                        break;
                    case 'shark':
                        messageHtml = createImageMessageHtml('https://media.discordapp.net/attachments/1219283420207906882/1219284374676050081/shark.png?ex=660abe10&is=65f84910&hm=f590036187593da1583f98a5c8e1047a2c6fdde4d929a96443894e1d04aeb139&=&format=webp&quality=lossless&width=800&height=800', 'text-emerald-600', 'text-gray-300', username, message);
                        break;
                    case 'lion':
                        messageHtml = createImageMessageHtml('https://media.discordapp.net/attachments/1219283420207906882/1219284374386900992/lion.png?ex=660abe10&is=65f84910&hm=6fcf46409cd7dbca33941a05e259176971f4a70e54c634d9d9777cd02107163f&=&format=webp&quality=lossless&width=800&height=800', 'text-orange-600', 'text-gray-300', username, message);
                        break;
                    case 'bear':
                        messageHtml = createImageMessageHtml('https://media.discordapp.net/attachments/1219283420207906882/1219284374067875850/bear.png?ex=660abe0f&is=65f8490f&hm=ecad8526918ef51b8ac8d3e2ebe25c20419fea40f9e8b56c5844edbbd138ff3d&=&format=webp&quality=lossless&width=800&height=800', 'text-blue-600', 'text-gray-400', username, message);
                        break;
                    default:
                        messageHtml = createMessageHtml('', 'text-gray-600', 'text-gray-400', username, message, false);
                    break;            
                }
            messageElements.forEach(element => {
                element.innerHTML += messageHtml;
            });
        }
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
