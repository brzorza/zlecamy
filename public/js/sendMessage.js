
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
                    const message = `
                            <div class="w-full">
                                <p class="w-4/5 ${item.sender_id === myId ? 'ml-auto bg-backgroundl' : 'mr-auto bg-backgroundll'} mt-4 text-justify text-white border border-primary rounded-lg p-4">
                                    ${item.text}
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