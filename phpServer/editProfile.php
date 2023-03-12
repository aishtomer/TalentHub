<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://kit.fontawesome.com/06f85f1f52.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&family=Lexend+Deca:wght@700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/phpServer/public/styles/editProfile.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"> </script>
</head>
<!-- -------------------------------- -->
<!-- body  -->

<body>
    <?php require "conn.php";
    
    $userId = $_GET['id'];
    
    if (isset($_COOKIE['user'])) {
      $user_id = $_COOKIE["user"];
      if($userId != $user_id){
          echo "<script>window.location.href = 'Home-page.php'</script>";
      }
    }else{
      header('Location: /phpServer/Landing-page-or-Login-page.php');
      exit;        
    }
    
    

    
        
        $result = $conn->query("SELECT ud.*, ld.first_name, ld.last_name, ld.email 
                                 FROM userDetails ud 
                                 JOIN loginDetails ld ON ud.user_id = ld.user_id
                                 WHERE ud.user_id = $userId"
                                );
        $awardResult = $conn->query("SELECT * FROM awardDetails WHERE user_id = $userId");
        $projectResult = $conn->query("SELECT * FROM projectDetails WHERE user_id = $userId");
        $careerResult = $conn->query("SELECT * FROM careerDetails WHERE user_id = $userId");
        $educationResult = $conn->query("SELECT * FROM educationDetails WHERE user_id = $userId");
        $skillResult = $conn->query("SELECT * FROM skillDetails WHERE user_id = $userId");
        if ($result->num_rows == 1) {
            // output the data of the row
            $row = $result->fetch_assoc();
        } else {
            echo "0 results or more than 1 result";
        }
    ?>
  <div id="first_container" class="container">
    <div id="row_head" class="row">
      <div class="col-xs-12 col-sm-4 col-md-2">
        <img class="rounded mx-auto d-block" src="/<?php echo $row["user_images"]?>" alt="Image not found" />
      </div>
      <div class="col-xs-12 col-md-10 col-sm-6">
        <div class="row ">
          <div class="col-6 justify-content-start ">
            <h1 class="editable-heading" data-id="1">
              <?php echo $row["first_name"].' '.$row["last_name"]; ?>
            </h1>
            <h3 class="editable-heading" data-id="1" style="color: white;">
              <?php echo $row["job_position"]; ?>
            </h3>
            <h4 class="editable-heading" data-id="1">
              <?php echo $row["location"]; ?>
            </h4>
          </div>
          <div class="col-6 allign_text">
          <div style="text-align: right;"><a href="editProfileHeader.php?id=<?php echo $row["user_id"]?>"><i class="fa-solid fa-pencil" style="margin-right: 0.7em; color: white;"></i></a></div> 
            <h3 style="color: white;" class="text-end editable-heading" data-id="1">
              <?php echo $row["email"]; ?>
            </h3>
            <h3 style="color: white;" class="text-end editable-heading" data-id="1">
              <?php echo $row["contact_no"]; ?>
            </h3>
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-warning justify-content-end btn-sm">Resume</button>
            </div>
          </div>
          <div class="row about_data">
            <h2 style="margin-top: 1.5rem;">About MySelf:</h2>
            <p class="editable-heading" data-id="1">
              <?php echo $row["about_myself"]; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div id="row_body" class="row body">
      <!-- dropdown for Skills  -->
      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
              aria-controls="panelsStayOpen-collapseOne">
              <h2>Skills:</h2>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
              <div class="icons">
                <a href="addSkill.php?id=<?php echo $userId?>"><i class="fa-solid fa-plus"
                      style="margin-bottom: 2em; margin-right: 0.3em;"></i></a></a>
              </div>
              <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col" style="display: none;">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title " data-id="1"></h5>
                      <p class="card-text " data-id="1"></p>
                      <p class="card-text " data-id="1"></p>
                    </div>
                  </div>
                </div>

                <?php 
                foreach ($skillResult as $skillrow) {
                  echo '
                  <div class="col">
                    <div class="card h-100">
                      <div class="card-body">
                        <div class="icons">
                          <a href="editSkill.php?id='.$skillrow['skill_id'].'"><i class="fa-solid fa-pencil"
                              style="margin-right: 0.7em;"></i></a>
                          <i '.(($skillrow['visibility'] !== "Public") ? 'class="fas fa-eye-slash"' : 'class="fa fa-eye"').' aria-hidden="true"></i>
                        </div>
                        <h5 class="card-title " data-id="1">
                          '.$skillrow['skill_name'].'
                        </h5>
                        <p class="card-text " data-id="1">
                          '.$skillrow['summary'].'
                        </p>
                        <p class="card-text " data-id="1">
                          '.$skillrow['more_detail'].'
                        </p>
                      </div>
                    </div>
                  </div>';                  
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseTwo">
              <h2>Awards:</h2>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
              <div class="icons">
                <a href="addAward.php?id=<?php echo $userId?>"><i class="fa-solid fa-plus"
                      style="margin-bottom: 2em; margin-right: 0.3em;"></i></a></a>
              </div>
              <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col" style="display: none;">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title " data-id="1"></h5>
                      <p class="card-text " data-id="1"></p>
                      <p class="card-text " data-id="1"></p>
                    </div>
                  </div>
                </div>

                <?php
                foreach ($awardResult as $awardrow) {
                    echo'
                      <div class="col">
                        <div class="card h-100">
                          <div class="card-body">
                            <div class="icons">
                              <a href="editAward.php?id='.$awardrow['award_id'].'"><i class="fa-solid fa-pencil"
                                  style="margin-right: 0.7em;"></i></a>
                              <i '.(($awardrow['visibility'] !== "Public") ? 'class="fas fa-eye-slash"' : 'class="fa fa-eye"').' aria-hidden="true"></i>
                            </div>
                            <h5 class="card-title " data-id="1">
                              '.$awardrow['award_name'].'
                            </h5>
                            <p class="card-text " data-id="1">
                              '.$awardrow['summary'].'
                            </p>
                            <p class="card-text " data-id="1">
                              '.$awardrow['more_detail'].'
                            </p>
                          </div>
                        </div>
                      </div>
                    ';
                }
                ?>

              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseThree">
              <h2>Projects:</h2>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingThree">
            <div class="accordion-body">
              <div class="icons">
                <a href="addProject.php?id=<?php echo $userId?>"><i class="fa-solid fa-plus"
                      style="margin-bottom: 2em; margin-right: 0.3em;"></i></a></a>
              </div>

                <?php
                foreach ($projectResult as $projectrow) {
                    echo'                    
                    <div class="card">
                      <img src="/'.$projectrow['image_path'].'" class="card-img-top" />
                      <div class="card-body">
                        <div class="icons">
                          <a href="editProject.php?id='.$projectrow['project_id'].'"><i class="fa-solid fa-pencil"
                              style="margin-right: 0.7em;"></i></a>
                          <i '.(($projectrow['visibility'] !== "Public") ? 'class="fas fa-eye-slash"' : 'class="fa fa-eye"').' aria-hidden="true"></i>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <h5 class="card-title">
                              <h2 data-id="1">
                                '.$projectrow['title'].'
                              </h2>
                            </h5>
                          </div>
                          <div class="card_title col-6">
                            <h5 class="card-title">
                              <h5 data-id="1"></h5>
                            </h5>
                          </div>
                        </div>
                        <h5 class="card-title " data-id="1">
                          '.$projectrow['subtitle'].'
                        </h5>
                        <p class="card-text " data-id="1">
                          '.$projectrow['detail'].'
                        </p>
                      </div>
                    </div> ';
                }
                ?>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true"
              aria-controls="panelsStayOpen-collapseFour">
              <h2>Education:</h2>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingFour">
            <div class="accordion-body">
              <div class="icons">
                <a href="addEducation.php?id=<?php echo $userId?>"><i class="fa-solid fa-plus"
                      style="margin-bottom: 2em; margin-right: 0.3em;"></i></a></a>
              </div>
              <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col" style="display: none;">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title " data-id="1"></h5>
                      <p class="card-text " data-id="1"></p>
                      <p class="card-text " data-id="1"></p>
                    </div>
                  </div>
                </div>
                <?php
                foreach ($educationResult as $educationrow) {
                    echo'
                      <div class="col">
                        <div class="card h-100">
                          <div class="card-body">
                            <div class="icons">
                              <a href="editEducation.php?id='.$educationrow['education_id'].'"><i class="fa-solid fa-pencil"
                                  style="margin-right: 0.7em;"></i></a>
                              <i '.(($educationrow['visibility'] !== "Public") ? 'class="fas fa-eye-slash"' : 'class="fa fa-eye"').' aria-hidden="true"></i>
                            </div>
                            <h5 class="card-title " data-id="1">
                              '.$educationrow['education_name'].'
                            </h5>
                            <p class="card-text " data-id="1">
                              '.$educationrow['summary'].'
                            </p>
                            <p class="card-text " data-id="1">
                              '.$educationrow['more_detail'].'
                            </p>
                          </div>
                        </div>
                      </div>                    
                    ';
                }?>

              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="true"
              aria-controls="panelsStayOpen-collapseFive">
              <h2>Career:</h2>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingFive">
            <div class="accordion-body">
              <div class="icons">
                <a href="addCareer.php?id=<?php echo $userId?>"><i class="fa-solid fa-plus"
                      style="margin-bottom: 2em; margin-right: 0.3em;"></i></a></a>
              </div>
              <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col" style="display: none;">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title " data-id="1"></h5>
                      <p class="card-text " data-id="1"></p>
                      <p class="card-text " data-id="1"></p>
                    </div>
                  </div>
                </div>
                <?php
                foreach ($careerResult as $careerrow) {
                    echo'                  
                        <div class="col">
                            <div class="card h-100">
                              <div class="card-body">
                                <div class="icons">
                                  <a href="editCareer.php?id='.$careerrow['career_id'].'"><i class="fa-solid fa-pencil"
                                      style="margin-right: 0.7em;"></i></a>
                                  <i '.(($careerrow['visibility'] !== "Public") ? 'class="fas fa-eye-slash"' : 'class="fa fa-eye"').' aria-hidden="true"></i>
                                </div>
                                <h5 class="card-title " data-id="1">
                                  '.$careerrow['career_name'].'
                                </h5>
                                <p class="card-text " data-id="1">
                                  '.$careerrow['summary'].'
                                </p>
                                <p class="card-text " data-id="1">
                                  '.$careerrow['more_detail'].'
                                </p>
                              </div>
                            </div>
                          </div>';

                }?>

              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="true"
              aria-controls="panelsStayOpen-collapseSix">
              <h2>More About <?php echo $row["first_name"]?>
              </h2>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
            aria-labelledby="panelsStayOpen-headingSix">
            <div class="accordion-body">
              <div class="icons">
                <a href="editAbout.php?id=<?php echo $row["user_id"]; ?>"><i class="fa-solid fa-pencil"></i></a>
              </div>
              <p data-id="6">
                <?php echo $row["more_about"]?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- accordion -->
</body>

</html>