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

  $(document).ready(function() {
    // Add a click event listener to the submit button
    $('#submit-btn').click(function() {
      // Loop through all editable headings and send their content to the backend
      $('.editable-heading').each(function() {
        var headingContent = $(this).text();
        var headingId = $(this).data('id');
        $.ajax({
          url: 'backend.php',
          type: 'POST',
          data: { headingContent: headingContent, headingId: headingId },
          success: function(response) {
            // Handle the response from the backend
          }
        });
      });
    });
  
    // Loop through all editable headings and make them editable
    $('.editable-heading').each(function() {
      var originalContent = $(this).text();
      $(this).attr('contenteditable', true);
      $(this).addClass('editing');
      $(this).data('original-content', originalContent);
    });
  
    // Add a blur event listener to all editable headings
    $('.editable-heading').blur(function() {
      $(this).attr('contenteditable', false);
      $(this).removeClass('editing');
      var newContent = $(this).text();
      var originalContent = $(this).data('original-content');
      if (newContent !== originalContent) {
        var headingId = $(this).data('id');
        // Send an AJAX POST request to the backend with the updated content
        $.ajax({
          url: 'backend.php',
          type: 'POST',
          data: { headingContent: newContent, headingId: headingId },
          success: function(response) {
            // Handle the response from the backend
          }
        });
      }
    });
  });

  