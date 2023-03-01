function toggleVisibility(icon) {
    icon.classList.toggle("fa-eye-slash");
    icon.classList.toggle("fa-eye");
  
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
    $('#submit-btn').click(function() {
      $('.editable-heading').each(function() {
        var headingContent = $(this).text();
        var headingId = $(this).data('id');
        $.ajax({
          url: 'backend.php',
          type: 'POST',
          data: { headingContent: headingContent, headingId: headingId },
          success: function(response) {
          }
        });
      });
    });
  
    $('.editable-heading').each(function() {
      var originalContent = $(this).text();
      $(this).attr('contenteditable', true);
      $(this).addClass('editing');
      $(this).data('original-content', originalContent);
    });
  
    $('.editable-heading').blur(function() {
      $(this).attr('contenteditable', false);
      $(this).removeClass('editing');
      var newContent = $(this).text();
      var originalContent = $(this).data('original-content');
      if (newContent !== originalContent) {
        var headingId = $(this).data('id');
        $.ajax({
          url: 'backend.php',
          type: 'POST',
          data: { headingContent: newContent, headingId: headingId },
          success: function(response) {
          }
        });
      }
    });
  });

  