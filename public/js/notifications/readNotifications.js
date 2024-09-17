function markNotificationRead(id, link){
    fetch(`/notifications/read/${id}`, {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        window.location.href = window.location.origin + link;
    })
    .catch(error => {
        console.error('ERROR:', error);
    });
}