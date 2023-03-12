<?php
// Set the cookie expiration time to a past date
setcookie('user', '', time() - 3600, '/');

// Redirect to the login page
header('Location: Landing-page-or-Login-page.php');
exit;
?>