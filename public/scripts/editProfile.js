function toggleVisibility(icon) {
    // toggle the icon classes
    icon.classList.toggle("fa-eye-slash");
    icon.classList.toggle("fa-eye");
  
    // send a POST request to the server
    fetch('/toggle-visibility', {
      method: 'POST',
      body: JSON.stringify({ card_id: icon.closest('.card').id }),
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));
  }