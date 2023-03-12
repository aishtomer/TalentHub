<html>
    <head>
        <title>Form</title>
        <link rel="stylesheet" href="/phpServer/public/styles/editSkill.css">
    </head>
    <body>
    <?php require "conn.php";
    
        if (isset($_COOKIE['user'])) {
        //   $user_id = $_COOKIE["user"];
        }else{
          header('Location: /phpServer/Landing-page-or-Login-page.php');
          exit;        
        }
        
        $user_id = $_GET['id'];
        $result = $conn->query("SELECT * FROM userDetails WHERE user_id = $user_id");
        if ($result->num_rows == 1) {
        // output the data of the row
            $row = $result->fetch_assoc();
        } else {
            echo "0 results or more than 1 result";
        }
        
        
        // check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $more_about = $_POST["more_about"];
            
            $sql = "UPDATE userDetails SET more_about = '$more_about' WHERE user_id = $user_id";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>window.location.href = 'editProfile.php?id=" . 1 . "';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }            
    ?>
        <h1>Edit More About</h1>

        <form action="" method="post" class="edit-skill-form">
            <div class="edit-skill-form">
                <label for="more_about">More About You: </label>
                <!-- Text area for the content of the article -->
                <textarea name="more_about" id="more_about" required><?php echo $row["more_about"]; ?></textarea>
            </div> 

            <div class="edit-skill-form">
                <!-- Submit button to update the article -->
                <input type="submit" value="Update">
            </div>
        </form>   
    </body>
</html>