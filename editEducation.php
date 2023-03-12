<html>
    <head>
        <title>Form</title>
        <link rel="stylesheet" href="/phpServer/public/styles/editSkill.css">
    </head>
    <body>
    <?php require "conn.php";
    
        if (isset($_COOKIE['user'])) {
          $user_id = $_COOKIE["user"];
        }else{
          header('Location: /phpServer/Landing-page-or-Login-page.php');
          exit;        
        }
    
        $education_id = $_GET['id'];
        
        $result = $conn->query("SELECT * FROM educationDetails WHERE education_id = $education_id");
        if ($result->num_rows == 1) {
        // output the data of the row
            $row = $result->fetch_assoc();
        } else {
            echo "0 results or more than 1 result";
        }
        
        
        // check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $education_name = $_POST["education_name"];
            $summary = $_POST["summary"];
            $more_detail = $_POST["more_detail"];
            
            if(isset($_POST['make_public']) && $_POST['make_public'] == "1") {
              $visibility = "Public";
            } else {
              $visibility = "Private";;
            }
            
            $sql = "UPDATE educationDetails SET education_name = '$education_name', summary = '$summary', more_detail = '$more_detail', visibility = '$visibility' WHERE education_id = $education_id";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>window.location.href = 'editProfile.php?id=" . $user_id . "';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }            
    ?>
        <h1>Edit Education</h1>

        <form action="" method="post" class="edit-skill-form">
            <div class="edit-skill-form">
                <label for="education_name">Education: </label>
                <!-- Input field for the title of the article -->
                <input type="text" name="education_name"  id="education_name" value="<?php echo $row["education_name"]; ?>" required>
            </div>

            <div class="edit-skill-form">
                <label for="summary">Summary: </label>
                <!-- Text area for the content of the article -->
                <textarea name="summary" id="summary" required><?php echo $row["summary"]; ?></textarea>
            </div> 

            <div class="edit-skill-form">
                <label for="more_detail">More Details: </label>
                <!-- Text area for the content of the article -->
                <textarea name="more_detail" id="more_detail" required><?php echo $row["more_detail"]; ?></textarea>
            </div> 

            <div class="edit-skill-form">
                <label for="make_public">Make public</label>
                <input type="checkbox" id="make_public" name="make_public" <?php if ($row["visibility"] === "Public") { echo 'checked'; } ?> value = 1
            </div>

            <div class="edit-skill-form">
                <!-- Submit button to update the article -->
                <input type="submit" value="Update">
            </div>

            <div class="edit-skill-form">
                <!-- Submit button to update the article -->
                <a href="deleteEducation.php?id=<?php echo $row['education_id']?>">Delete</a>
            </div>
        </form>   
    </body>
</html>