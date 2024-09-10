const openCreator = document.getElementById('open-create-offer');
const closeCreator = document.getElementById('close-create-offer');

function toggleClass() {
    const targetElement = document.getElementById('create-offer-wrapper');

    targetElement.classList.toggle('hidden');
}

if(openCreator){
    openCreator.addEventListener('click', toggleClass);
}
if(closeCreator){
    closeCreator.addEventListener('click', toggleClass);
}