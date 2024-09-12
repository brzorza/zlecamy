const popupDiv = document.getElementById("confirmation-status-wrapper");

function getParentFormId(selectElement) {
    var parentForm = selectElement.closest("form");

    return parentForm.id;
}

function getSelectedValue(selectElement) {
    return selectElement.value;
}

function clearPopup(formId) {
    popupDiv.innerHTML = "";
    document.getElementById(formId).querySelector("select").selectedIndex = 0;
}

function sendChosenForm(formId) {
    document.getElementById(`${formId}`).submit();
}

function appendNewHtmlContent(selectValue, formId) {
    // Każdy inny status
    var popupText;
    if (selectValue == "cancel") {
        popupText = "Anulowane";
    } else if (selectValue == "finish") {
        popupText = "Zakończone";
    } else if (selectValue == "in_proggres") {
        popupText = "W takcie";
    }

    var confDiv = `<h3 class="text-gray-500 text-3xl text-center mb-6">Czy napewno chcesz zmienić status na <span class="text-primary">"${popupText}"</span> ?</h3>
                            <div class="flex flex-row justify-between">
                                <div class="border border-primary py-4 px-16 rounded-xl text-lg font-semibold hover:bg-primary hover:text-background cursor-pointer" 
                                    onclick="sendChosenForm('${formId}');">Tak</div>
                                <div class="border border-danger py-4 px-16 rounded-xl text-lg font-semibold hover:bg-danger hover:text-background cursor-pointer" 
                                    onclick="togglePopupWrapper(); clearPopup('${formId}');">Nie</div>
                            </div>`;

    if (popupDiv && confDiv) {
        popupDiv.insertAdjacentHTML("beforeend", confDiv);
    } else {
        console.log("Target div not found.");
    }

    togglePopupWrapper();
}

function togglePopupWrapper() {
    document
        .getElementById("confirmation-status-wrapper-wrap")
        .classList.toggle("hidden");
}

function redirectToChat(chatId) {
    window.location.href = `/profile/chat/${chatId}`;
}


function payForOrder(orderId) {
    const form = document.getElementById(`${orderId}`);

    if (!form) {
        console.error('Form with ID "paymentForm" not found.');
        return;
    }

    // Construct the URL with the orderId
    const url = `/order/pay/${orderId}`;

    // Update the form action
    form.action = url;

    // Submit the form
    form.submit();
}

// If we sumit pay we change form url and then submit this form that already exists
document.querySelectorAll("select").forEach((selectElement) => {
    selectElement.addEventListener("change", function () {
        if (this.value == "show") {
            showOrderInfo(getParentFormId(this));
        } else if (this.value == "pay") {
            payForOrder(getParentFormId(this));
        } else {
            appendNewHtmlContent(getSelectedValue(this), getParentFormId(this));
        }
    });
});
