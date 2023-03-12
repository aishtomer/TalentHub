<?php 

    require "conn.php";
    
    if (isset($_COOKIE['user'])) {
      $user_id = $_COOKIE["user"];
    }else{
      header('Location: /phpServer/Landing-page-or-Login-page.php');
      exit;        
    }
    
    $education_id = $_GET['id'];
    
    $sql = "DELETE FROM educationDetails WHERE education_id = $education_id";

    if ($conn->query($sql) === TRUE) {
      header("Location: /phpServer/editProfile.php?id=1");
    } else {
      echo "Error deleting record: " . $conn->error;
    }
?>