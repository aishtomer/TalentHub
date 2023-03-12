<html>
    <head>
        <title>Form</title>
        <link rel="stylesheet" href="/phpServer/public/styles/editProfileHeader.css">
    </head>
    <body>
        <?php require "conn.php";
            $user_id = $_GET['id'];
            $result = $conn->query("SELECT ud.*, ld.first_name, ld.last_name, ld.email 
                         FROM userDetails ud 
                         JOIN loginDetails ld ON ud.user_id = ld.user_id
                         WHERE ud.user_id = $user_id"
                        );
            $awardResult = $conn->query("SELECT * FROM awardDetails WHERE user_id = $user_id");
            if ($result->num_rows == 1) {
            // output the data of the row
                $row = $result->fetch_assoc();
            } else {
                echo "0 results or more than 1 result";
            }
            
            
            // check if the form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                // get the form data
                $job_position = $_POST["job_position"];
                $contact_no = $_POST["contact_no"];
                $about_myself = $_POST["about_myself"];
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                
                if ($_FILES['user_images']['error'] == UPLOAD_ERR_OK) {
                    $file_name = $_FILES['user_images']['name'];
                    $file_size = $_FILES['user_images']['size'];
                    $file_tmp = $_FILES['user_images']['tmp_name'];
                    $file_type = $_FILES['user_images']['type'];
                    $file_ext_arr = explode('.', $file_name);
                    $file_ext = strtolower(end($file_ext_arr));
                    
                    $extensions = array("jpeg","jpg","png");
                    
                    if(in_array($file_ext,$extensions)=== false){
                        echo "Extension not allowed, please choose a JPEG or PNG file.";
                    }
                    
                    if($file_size > 2097152) {
                        echo 'File size must be less than 2 MB';
                    }
                    
                    $upload_dir = 'images/user_images';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    $upload_path = $upload_dir .'/'. basename($file_name);
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        echo "Success! Image uploaded to: ".$upload_path;
                    } else {
                        echo "Error uploading image.";
                    }
                    $sql1 = "UPDATE userDetails SET job_position = '$job_position', contact_no = '$contact_no', about_myself = '$about_myself', user_images = 'phpServer/images/user_images/$file_name' WHERE user_id = $user_id"; 
                } else {
                    $sql1 = "UPDATE userDetails SET job_position = '$job_position', contact_no = '$contact_no', about_myself = '$about_myself' WHERE user_id = $user_id"; 
                }
                
                $sql2 = "UPDATE loginDetails SET first_name = '$firstName', last_name = '$lastName' WHERE user_id = $user_id";
                
                if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
                    echo "<script>window.location.href = 'editProfile.php?id=" . $user_id . "';</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }            
        ?>
        <h1>Edit Profile Header</h1>

        <form action="" method="post" class="edit-header-form" enctype="multipart/form-data">
            <div class="edit-header-form">
                <label for="user_images">Profile Image:</label>
                <input type="file" id="user_images" name="user_images" value="/<?php echo $row["user_images"]; ?>">
            </div>
            <div class="edit-header-form">
                <label for="firstName">First Name: </label>
                <!-- Input field for the title of the article -->
                <input type="text" name="firstName"  id="firstName" value="<?php echo $row["first_name"]; ?>" required>
            </div>

            <div class="edit-header-form">
                <label for="lastName">Last Name: </label>
                <!-- Input field for the subtitle of the article -->
                <input type="text" name="lastName"  id="lastName" value="<?php echo $row["last_name"]; ?>" required>
            </div>

            <div class="edit-header-form">
                <label for="job_position">Job Title: </label>
                <!-- Input field for the title of the article -->
                <input type="text" name="job_position"  id="job_position" value="<?php echo $row["job_position"]; ?>" required>
            </div>

            <div class="edit-header-form">
                <label for="current_location">Location: </label>
                <!-- Input field for the subtitle of the article -->
                <input type="text" name="current_location"  id="current_location" value="<?php echo $row["location"]; ?>" required>
            </div>

            <div class="edit-header-form">
                <label for="contact_no">Phone Number: </label>
                <!-- Input field for the title of the article -->
                <input type="text" name="contact_no"  id="contact_no" value="<?php echo $row["contact_no"]; ?>" required>
            </div>

            <div class="edit-header-form">
                <label for="about_myself">About: </label>
                <!-- Text area for the content of the article -->
                <textarea name="about_myself" id="about_myself" required><?php echo $row["about_myself"]; ?></textarea>
            </div> 

            <div class="edit-header-form">
                <!-- Submit button to update the article -->
                <input type="submit" value="Update">
            </div>
        </form>   
    </body>
</html>