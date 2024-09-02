function clearPopup(formId){
    popupDiv.innerHTML = '';
    document.getElementById(formId).querySelector('select').selectedIndex = 0;
    console.log(currentSelectForPopup);
    // 
}

function appendNewHtmlContent(selectValue, formId) {
    if(selectValue == 'show'){
        // Status pokaż

    } else {
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
    }

    togglePopupWrapper();
}

document.querySelectorAll('select').forEach(selectElement => {
    selectElement.addEventListener('change', function() {

        appendNewHtmlContent(getSelectedValue(this), getParentFormId(this));

    });
});