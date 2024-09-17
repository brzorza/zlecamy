document.addEventListener("DOMContentLoaded", function () {
    var bellIcon = document.querySelector(".bell-notification");
    var notificationsWrapper = document.querySelector(".notifications-wrapper");

    if (bellIcon && notificationsWrapper) {
        bellIcon.addEventListener("click", function () {
            notificationsWrapper.classList.toggle("hidden");
        });
    }
});