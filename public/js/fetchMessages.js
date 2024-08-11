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
            const message = `
                    <div class="w-full">
                        <p class="w-4/5 ${item.sender_id === myId ? 'ml-auto bg-backgroundl' : 'mr-auto bg-backgroundll'} mt-4 text-justify text-white border border-primary rounded-lg p-4">
                            ${item.text}
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