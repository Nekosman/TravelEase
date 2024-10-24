const menuToggle = document.getElementById('menu-toggle');
const headerTitleToggle = document.getElementById('header-title-toggle');
const container = document.querySelector('.container');
const chatContainer = document.querySelector('.chat-container');
const messageInput = document.querySelector('.message-input');
const sendButton = document.querySelector('.send-button');

menuToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});

headerTitleToggle.addEventListener('click', function() {
    container.classList.toggle('show-sidebar');
});

sendButton.addEventListener('click', function() {
    const messageText = messageInput.value.trim();
    if (messageText) {
        const newMessage = document.createElement('div');
        newMessage.classList.add('chat-message', 'sender');
        newMessage.innerHTML = `<span>${messageText}</span>`;
        chatContainer.appendChild(newMessage);
        messageInput.value = '';
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
});

document.getElementById('back-to-ticket').addEventListener('click', function() {
    window.location.href = "{{ route('tickets.index') }}";
});
