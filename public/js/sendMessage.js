
    const sendForm = document.getElementById('messageForm');
    
        sendForm.addEventListener('submit', function(event) {
            event.preventDefault();
    
            const chat_id = document.getElementById('chat_id').value;
            const text = document.getElementById('text').value;
    
            // Get form data
            const formData = new FormData();
            formData.append('chat_id', chat_id);
            formData.append('text', text);
    
            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
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
    
                document.getElementById('text').value = '';
                scrollToBottom();
    
            })
            .catch(error => {
                console.error('ERROR:', error);
            });
        });