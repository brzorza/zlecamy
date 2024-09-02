const popupDiv = document.getElementById('confirmation-status-wrapper');


function getParentFormId(selectElement) {

    var parentForm = selectElement.closest('form');

    return parentForm.id;

}

function getSelectedValue(selectElement) {
    return selectElement.value;
}

function clearPopup(formId){
    popupDiv.innerHTML = '';
    document.getElementById(formId).querySelector('select').selectedIndex = 0; 
}

function sendChosenForm(formId){
    document.getElementById(`${formId}`).submit();
}

function appendNewHtmlContent(selectValue, formId) {
        // Każdy inny status
        var popupText;
        if(selectValue == 'cancel'){
            popupText = 'Anulowane';
        } else if(selectValue == 'finish'){
            popupText = 'Zakończone';
        } else if(selectValue == 'in_proggres'){
            popupText = 'W takcie';
        }

        var confDiv = `<h3 class="text-gray-500 text-3xl text-center mb-6">Czy napewno chcesz zmienić status na <span class="text-primary">"${popupText}"</span> ?</h3>
                            <div class="flex flex-row justify-between">
                                <div class="border border-primary py-4 px-16 rounded-xl text-lg font-semibold hover:bg-primary hover:text-background cursor-pointer" 
                                    onclick="sendChosenForm('${formId}');">Tak</div>
                                <div class="border border-danger py-4 px-16 rounded-xl text-lg font-semibold hover:bg-danger hover:text-background cursor-pointer" 
                                    onclick="togglePopupWrapper(); clearPopup('${formId}');">Nie</div>
                            </div>`;

        if (popupDiv && confDiv) {
            popupDiv.insertAdjacentHTML('beforeend', confDiv);
        } else {
            console.log("Target div not found.");
        }
    

    togglePopupWrapper();
}

function togglePopupWrapper(){
    document.getElementById('confirmation-status-wrapper-wrap').classList.toggle('hidden');
}

function redirectToChat(chatId){
    window.location.href = `/profile/chat/${chatId}`;
}

function showOrderInfo(orderID){

    fetch(`/order/show/${orderID}`, {
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

        // Check and replace deadline 
        if(data.data.deadline == null){
            var deadline = '-';
        }else{
            var deadline = data.data.deadline;
        }

        // Replace status to readable form
        const dictionary = {
            'new': 'Nowy',
            'paid': 'Opłacone',
            'in_progress': 'W trakcie',
            'finished': 'Zakończone',
            'expired': 'Wygasło',
            'cancelled': 'Anulowane',
        };

        const status = dictionary[data.data.status];

        var showDiv = `<div>
                            <div class="flex felx-row w-full gap-10 mb-6">
                                <img src="/storage/images/offerCovers/1W2dV4ZMkQrIoDXYB3T645GyOnNzJrvj27f7UU64.webp" alt="Okładka oferty" class="user-offers-aspect max-w-96 rounded-xl">
                                <div class="flex flex-col align-center justify-center">
                                    <p class="text-xl font-semibold">Status: <span class="text-gray-400 text-md font-normal">${status}</span></p>
                                    <p class="text-xl font-semibold">Cena: <span class="text-gray-400 text-md font-normal">${data.data.price}zł</span></p>
                                    <p class="text-xl font-semibold">Czas realizacji: <span class="text-gray-400 text-md font-normal">${data.data.order_ready_in} dni</span></p>
                                    <p class="text-xl font-semibold">Dostępne do: <span class="text-gray-400 text-md font-normal">${deadline}</span></p>
                                </div>
                            </div>
                            <div class="mb-6">
                                <p class="text-xl font-semibold">Opis:</p>
                                <p>Hi, I am Bikash from Bangladesh. I have been working as a Frontend Web Developer since 2021. I specialize in crafting visually appealing landing pages and portfolio websites. If you're in need of an eye-catching and budget-friendly landing page design, feel free to reach out to me.</p>
                            </div>
                            <div class="flex flex-row justify-between w-full">
                                <div class="border border-primary py-4 px-16 rounded-xl text-lg font-semibold hover:bg-primary hover:text-background cursor-pointer"
                                    onclick="redirectToChat('${data.data.chat_id}');">Pokaż chat</div>
                                <div class="border border-danger py-4 px-16 rounded-xl text-lg font-semibold hover:bg-danger hover:text-background cursor-pointer"
                                    onclick="togglePopupWrapper(); clearPopup('${data.data.id}');">Zamknij</div>
                            </div>
                        </div>`;

        if (popupDiv && showDiv) {
            popupDiv.insertAdjacentHTML('beforeend', showDiv);
        } else {
            console.log("Target div not found.");
        }

    })
    .catch(error => {
        console.error('ERROR:', error);
    });

    togglePopupWrapper();
}

document.querySelectorAll('select').forEach(selectElement => {
    selectElement.addEventListener('change', function() {

        if(this.value == 'show'){
            showOrderInfo(getParentFormId(this));
        }else{
            appendNewHtmlContent(getSelectedValue(this), getParentFormId(this));
        }

    });
});
