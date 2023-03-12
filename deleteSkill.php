<?php 

    require "conn.php";
    
    if (isset($_COOKIE['user'])) {
      $user_id = $_COOKIE["user"];
    }else{
      header('Location: /phpServer/Landing-page-or-Login-page.php');
      exit;        
    }
        
    $skill_id = $_GET['id'];
    
    $sql = "DELETE FROM skillDetails WHERE skill_id = $skill_id";

    if ($conn->query($sql) === TRUE) {
      header("Location: /phpServer/editProfile.php?id=$user_id");
    } else {
      echo "Error deleting record: " . $conn->error;
    }
?>