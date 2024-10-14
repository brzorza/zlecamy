const initialData = {
    description: [

    ],
};

const quill = new Quill('#editor', {
    theme: 'snow'
});


const form = document.getElementById('form');
const formInput = document.getElementById('description');
const formSubmitButton = document.getElementById('form-submit-quill');

function checkTitle(){
    let title = document.querySelector('input[name="title"]');

    let errorElement = document.getElementById('title-error');
    errorElement.textContent = '';

    // Check if we should display error about title
    if (title.value.length > 100 || title.value.length < 1) {
        errorElement.textContent = "Tytuł nie może być pusty i może mieć maksymalnie 100 znaków";
        return false;
    } else {
        return true;
    }
}

// Check for description error
function checkDescription(){
    let description = JSON.stringify(quill.getContents().ops);

    let errorElement = document.getElementById('description-error');
    errorElement.textContent = '';

    // Check if we should display error about description
    if (description.length > 65535) {
        errorElement.textContent = "Opis jest zbyt długi";

        // const errorElements = document.querySelectorAll('.error');

        // // Loop through each error element and set its content to an empty string
        // errorElements.forEach(function(element) {
        //     element.textContent = '';
        // });

        return false;
    } else {
        return true;
    }
}

function checkLocalization(){
    let localization = document.querySelector('input[name="localization"]');

    let errorElement = document.getElementById('localization-error');
    errorElement.textContent = '';

    // Check if we should display error about localization
    if (localization.value.length > 20 || localization.value.length < 1) {
        errorElement.textContent = "Lokalizacja nie może być pusta i może mieć maksymalnie 20 znaków";
        return false;
    } else {
        return true;
    }
}

function checkCategory(){
    let category_id = document.querySelector('select[name="category_id"]');

    let errorElement = document.getElementById('category_id-error');
    errorElement.textContent = '';

    // Check if we should display error about category_id
    if (category_id.value === '') {
        errorElement.textContent = "Musisz wybrać kategorię";
        return false;
    } else {
        return true;
    }
}

function checkPrice() {
    let priceInput = document.querySelector('input[name="price"]');
    
    let errorElement = document.getElementById('price-error');
    errorElement.textContent = '';

    let priceValue = parseInt(priceInput.value, 10);

    // Check if the value is a valid integer and within the range
    if (isNaN(priceValue) || priceValue < 0 || priceValue > 100000) {
        errorElement.textContent = "Cena musi być cyfrą pomiędzy 0 a 100.000";
        return false;
    } else {
        return true;
    }
}

function checkDeliveryTime(){
    let delivery_time = document.querySelector('input[name="delivery_time"]');

    let errorElement = document.getElementById('delivery_time-error');
    errorElement.textContent = '';

    // Check if we should display error about delivery time
    if (delivery_time.value.length > 50 || delivery_time.value.length < 1) {
        errorElement.textContent = "Czas dostawy nie może być pusty i może mieć maksymalnie 50 znaków";
        return false;
    } else {
        return true;
    }
}

formSubmitButton.addEventListener('click', (event) => {

    event.preventDefault();
    
    if(checkDescription() && checkTitle() && checkLocalization() && checkCategory() && checkPrice() && checkDeliveryTime()){
        formInput.value = JSON.stringify(quill.getContents().ops);
    
        form.submit();
    }

});