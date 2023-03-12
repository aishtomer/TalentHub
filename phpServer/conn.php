<?php
$servername = "localhost";
$username = "id20320564_talenthub_user";
$password = "hym8*uGw5n<3Xb-N";
$dbname = "id20320564_talenthub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>