<?php
if (!isset($_COOKIE['user'])) {
  header('Location: /phpServer/.php');
  exit;
}
?>

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
        
        $project_id = $_GET['id'];
        $result = $conn->query("SELECT * FROM projectDetails WHERE project_id = $project_id");
        if ($result->num_rows == 1) {
        // output the data of the row
            $row = $result->fetch_assoc();
        } else {
            echo "0 results or more than 1 result";
        }
        
        
        // check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $title = $_POST["title"];
            $subtitle = $_POST["subtitle"];
            $detail = $_POST["detail"];
            
            if(isset($_POST['make_public']) && $_POST['make_public'] == "1") {
              $visibility = "Public";
            } else {
              $visibility = "Private";;
            }
            
            if ($_FILES['image_path']['error'] == UPLOAD_ERR_OK) {
                $file_name = $_FILES['image_path']['name'];
                $file_size = $_FILES['image_path']['size'];
                $file_tmp = $_FILES['image_path']['tmp_name'];
                $file_type = $_FILES['image_path']['type'];
                $file_ext_arr = explode('.', $file_name);
                $file_ext = strtolower(end($file_ext_arr));
                
                $extensions = array("jpeg","jpg","png");
                
                if(in_array($file_ext,$extensions)=== false){
                    echo "Extension not allowed, please choose a JPEG or PNG file.";
                }
                
                if($file_size > 2097152) {
                    echo 'File size must be less than 2 MB';
                }
                
                $upload_dir = 'images/project_images';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $upload_path = $upload_dir .'/'. basename($file_name);
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    echo "Success! Image uploaded to: ".$upload_path;
                } else {
                    echo "Error uploading image.";
                }
                $sql = "UPDATE projectDetails SET title = '$title', subtitle = '$subtitle', detail = '$detail', visibility = '$visibility', image_path = 'phpServer/images/project_images/$file_name' WHERE project_id = $project_id"; 
            } else {
                $sql = "UPDATE projectDetails SET title = '$title', subtitle = '$subtitle', detail = '$detail', visibility = '$visibility' WHERE project_id = $project_id";
            }      
            
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>window.location.href = 'editProfile.php?id=" . $user_id . "';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }            
    ?>
        <h1>Edit Project</h1>
    
        <form action="" method="post" class="edit-skill-form" enctype="multipart/form-data">
            <div class="edit-skill-form">
                <label for="image_path">Project Image:</label>
                <input type="file" id="image_path" name="image_path" value="<?php echo $row["image_path"]; ?>">
            </div>
            <div class="edit-skill-form">
                <label for="title">Project Title: </label>
                <!-- Input field for the title of the article -->
                <input type="text" name="title" id="title"
                    value="<?php echo $row["title"]; ?>" required>
            </div>
    
            <div class="edit-skill-form">
                <label for="subtitle">Project Subtitle: </label>
                <!-- Input field for the subtitle of the article -->
                <input type="text" name="subtitle" id="subtitle"
                    value="<?php echo $row["subtitle"]; ?>" required>
            </div>
    
            <div class="edit-skill-form">
                <label for="detail">Description: </label>
                <!-- Text area for the content of the article -->
                <textarea name="detail" id="detail"
                    required><?php echo $row["detail"]; ?></textarea>
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
                <a href="deleteProject.php?id=<?php echo $row["project_id"]; ?>">Delete</a>
            </div>
        </form>
    </body>
</html>