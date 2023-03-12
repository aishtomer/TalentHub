<?php
    // Get the search query from the GET parameters
    $query = $_GET['query'];
    $num_rows_loaded = $_GET['num_rows_loaded'];
    // Make sure the query is not empty
    if (!empty($query)) {
      // Connect to your database using mysqli or PDO
      require "conn.php";
      // Execute the search query
      $stmt = $conn->prepare("SELECT ud.*, DATE(ud.created_date) AS date_created, ld.first_name, ld.last_name, ld.email 
                        FROM userDetails ud 
                        JOIN loginDetails ld ON ud.user_id = ld.user_id  
                        WHERE job_position LIKE ? ORDER BY created_date DESC LIMIT 10");
      $search_query = '%' . $query . '%';
      $stmt->bind_param('s', $search_query);
      $stmt->execute();
      $result = $stmt->get_result();
      // Format the search results as HTML
      while ($row = $result->fetch_assoc()) {
        echo '
            <a href="#" onclick="redirectToProfile('.$row['user_id'].')">
                <div class="card card-1">
                    <img src="/'.$row['user_images'].'" class="card-img-top" />
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-7">
                                <h3 class="card-title">'.$row['first_name'].' '.$row['last_name'].'</h3>
                            </div>
                            <div class="col-5">
                                <h6>'.$row['date_created'].'</h6>
                            </div>
                        </div>
                        <h5 id="h5">'.$row['location'].'</h5>
                        <p class="card-text">'.$row['about_myself'].'</p>
                    </div>
                </div>
            </a>
        ';
        $num_rows_loaded++;
      }
      echo '<script>num_rows_loaded = ' . $num_rows_loaded . ';</script>';
    }
?>

<script>
    function redirectToProfile(userId) {
      // Redirect the user to the profile page with the user id as a parameter
      window.location.href = 'viewProfile.php?id=' + userId;
    }    
</script>