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

            const year = date.getFullYear();
            const month = date.toLocaleString('pl-PL', { month: 'long' }).slice(0, 3);
            const capitalizedMonth = month.charAt(0).toUpperCase() + month.slice(1);
            const day = date.getDate().toString().padStart(2, '0');
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');

            if(item.type == 'text'){
                var message = `
                        <div class="w-full">
                            <p class="w-4/5 relative ${item.sender_id === myId ? 'ml-auto bg-backgroundl' : 'mr-auto bg-backgroundll'} mt-4 text-justify text-white border border-primary rounded-lg p-4">
                                ${item.value}
                                <span class="text-date">${year} ${capitalizedMonth} ${day} ${hours}:${minutes}</span>
                            </p>
                        </div>
                    `;
            }else if(item.type == 'order'){
                var message = `
                        <div class="w-full">
                            <div class="w-2/5 relative mx-auto mt-4 text-center bg-background border-2 border-primary rounded-lg p-6">
                                <p class="text-xl font-semibold text-white ">Status zamówienia</p>
                                <p class="text-base font-normal mb-6">${item.value}</p>
                                <a href="#" class="border-2 border-primary bg-primary hover:bg-background hover:text-white rounded text-background font-semibold py-2 px-12 min-w-5 w-1/2 mx-auto font-semibold">Zobacz</a>
                            </div>
                        </div>
                    `;
            }

            chatContainer.insertAdjacentHTML('beforeend', message);
        })

        // scrollToBottom();

    })
    .catch(error => {
        console.error('ERROR:', error);
    });
}
// TODO fix fetch time
setInterval(getMessages, 5000);