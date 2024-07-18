function openDeleteConfirmation(deleteUrl) {
    // Set the action of the delete form
    document.getElementById("deleteOfferForm").action = deleteUrl;

    // Show the modal
    document
        .getElementById("deleteConfirmationModal")
        .classList.remove("hidden");
}

function closeDeleteConfirmation() {
    // Hide the modal
    document.getElementById("deleteConfirmationModal").classList.add("hidden");
}
