// TODO dodać do bazy
document.addEventListener('DOMContentLoaded', () => {
    const texts = ["garfik do projektów?", "dubbingu do video?", "reklamy dla firmy?", "animacji 2D / 3D?", "strony dla biznesu?"];
    let currentTextIndex = 0;
    let charIndex = 0;
    const typingElement = document.getElementById('typing-animation');
    const typingSpeed = 100; // Typing speed in ms
    const deletingSpeed = 50; // Deleting speed in ms
    const pauseBetween = 2000; // Pause time between sentences in ms

    function type() {
        if (charIndex < texts[currentTextIndex].length) {
            typingElement.innerHTML += texts[currentTextIndex].charAt(charIndex);
            charIndex++;
            setTimeout(type, typingSpeed);
        } else {
            setTimeout(deleteText, pauseBetween);
        }
    }

    function deleteText() {
        if (charIndex > 0) {
            typingElement.innerHTML = texts[currentTextIndex].substring(0, charIndex - 1);
            charIndex--;
            setTimeout(deleteText, deletingSpeed);
        } else {
            currentTextIndex = (currentTextIndex + 1) % texts.length;
            setTimeout(type, typingSpeed);
        }
    }

    type();
});