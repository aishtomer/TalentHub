<?php
// Connect to the SQLite3 database
$pdo = new PDO('sqlite:../../database.db');

// Fetch user details from the database
$stmt = $pdo->query('SELECT * FROM userDetails WHERE user_id = 1');
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Output the user details as HTML
echo '<p>Email: ' . $data['email'] . '</p>';
echo '<p>First Name: ' . $data['first_name'] . '</p>';
echo '<p>Last Name: ' . $data['last_name'] . '</p>';
?>