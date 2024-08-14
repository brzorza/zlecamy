function getMessages(){
    const chatId = document.getElementById('chat_id').value;

    fetch(`/chat/get?chat_id=${chatId}`, {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Handle success

        // Empty chat box
        const chatContainer = document.getElementById('chatContainer');
        chatContainer.innerHTML = '';

        // Genereate chat
        data.data.forEach(item => {

            // Convert date to +2 date
            const date = new Date(item.created_at);
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');

            const message = `
                    <div class="w-full">
                        <p class="w-4/5 relative ${item.sender_id === myId ? 'ml-auto bg-backgroundl' : 'mr-auto bg-backgroundll'} mt-4 text-justify text-white border border-primary rounded-lg p-4">
                            ${item.text}
                            <span class="text-date">${hours}:${minutes}</span>
                        </p>
                    </div>
                `;
            chatContainer.insertAdjacentHTML('beforeend', message);
        })

        scrollToBottom();

    })
    .catch(error => {
        console.error('ERROR:', error);
    });
}

setInterval(getMessages, 5000);