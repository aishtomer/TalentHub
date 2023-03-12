<html>
    <head>
        <title>Form</title>
        <link rel="stylesheet" href="/phpServer/public/styles/editSkill.css">
    </head>
    <body>
    <?php require "conn.php";
        $user_id = $_GET['id'];
        
        if (isset($_COOKIE['user'])) {
        //   $user_id = $_COOKIE["user"];
        }else{
          header('Location: /phpServer/Landing-page-or-Login-page.php');
          exit;        
        }
        
        // check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $job_position = $_POST["job_position"];
            $location = $_POST["location"];
            $contact_no = $_POST["contact_no"];
            $about_myself = $_POST["about_myself"];
            $more_about = $_POST["more_about"];
        
            
            $sql = "INSERT INTO userDetails(job_position, location, contact_no, about_myself, more_about, user_images, user_id) VALUES ('$job_position', '$location', '$contact_no', '$about_myself', '$more_about', 'images/user_images/user_default_image.png', '$user_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>window.location.href = 'editProfile.php?id=" . $user_id . "';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }            
    ?>
        <h1>Add New Profile</h1>

        <form action="" method="post" class="edit-skill-form">
            <div class="edit-skill-form">
                <label for="job_position">Job Position: </label>
                <!-- Input field for the title of the article -->
                <input type="text" name="job_position"  id="job_position" required>
            </div>

            <div class="edit-skill-form">
                <label for="location">Location: </label>
                <!-- Text area for the content of the article -->
                <textarea name="location" id="location" required></textarea>
            </div> 

            <div class="edit-skill-form">
                <label for="contact_no">Contact No: </label>
                <!-- Text area for the content of the article -->
                <textarea type = "phone number" name="contact_no" id="contact_no" required></textarea>
            </div> 

            <div class="edit-skill-form">
                <label for="about_myself">About Yourself:</label>
                <input type="text" id="about_myself" name="about_myself">
            </div>
            
            <div class="edit-skill-form">
                <label for="more_about">About More:</label>
                <input type="text" id="more_about" name="more_about">
            </div>

            <div class="edit-skill-form">
                <!-- Submit button to update the article -->
                <input type="submit" value="Add Profile">
            </div>
        </form>    
    </body>
</html>