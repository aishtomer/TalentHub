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
        
        // check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $skill_name = $_POST["skill_name"];
            $summary = $_POST["summary"];
            $more_detail = $_POST["more_detail"];
            
            if(isset($_POST['make_public']) && $_POST['make_public'] == "1") {
              $visibility = "Public";
            } else {
              $visibility = "Private";
            }
            
            $sql = "INSERT INTO skillDetails(skill_name, summary, more_detail, visibility, user_id) VALUES ('$skill_name', '$summary', '$more_detail', '$visibility', '$user_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>window.location.href = 'editProfile.php?id=" . $user_id . "';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }            
    ?>
        <h1>Add New Skill</h1>

        <form action="" method="post" class="edit-skill-form">
            <div class="edit-skill-form">
                <label for="skill_name">Skill: </label>
                <!-- Input field for the title of the article -->
                <input type="text" name="skill_name"  id="skill_name" required>
            </div>

            <div class="edit-skill-form">
                <label for="summary">Summary: </label>
                <!-- Text area for the content of the article -->
                <textarea name="summary" id="summary" required></textarea>
            </div> 

            <div class="edit-skill-form">
                <label for="more_detail">More Details: </label>
                <!-- Text area for the content of the article -->
                <textarea name="more_detail" id="more_detail" required></textarea>
            </div> 

            <div class="edit-skill-form">
                <label for="make_public">Make public</label>
                <input type="checkbox" id="make_public" name="make_public" value = 1>
            </div>

            <div class="edit-skill-form">
                <!-- Submit button to update the article -->
                <input type="submit" value="Add Skill">
            </div>
        </form>    
    </body>
</html>