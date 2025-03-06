document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    fetch('contact_api.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => alert(result))
    .catch(error => console.error('Error:', error));
});
