<?php
require "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["validatepassword"];
    
    $checkExistQuery = mysqli_query($conn, "SELECT * FROM loginDetails WHERE email = '$email'");
    $numRows = mysqli_num_rows($checkExistQuery);
    
    if ($numRows == 0) {
        $emailError = false;
    }else{
        $emailErrorMessage = 'Email has been used.';
        $emailError = true;
    }
    if(preg_match("/^[a-zA-Z ]*$/",$name)){
        $nameError = false;
    }else{
        $nameErrorMessage = 'Only alphabet characters and spaces are allowed.';
        $nameError = true;
    }
    if(preg_match("/^[a-zA-Z ]*$/",$surname)){
        $surNameError = false;
    }else{
        $surNameErrorMessage = 'Only alphabet characters and spaces are allowed.';
        $surNameError = true;
    }
    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $passwordError = false;

    }else{
        $passwordErrorMessage = 'Password must contain at least 8 characters, including at least one lowercase letter, one uppercase letter, one number, and one special character.';
        $passwordError = true;
    }
    if ($password == $confirm_password) {
        $confirm_passwordError = false;
    }else{
        $confirm_passwordErrorMessage = 'Password is not same as the previous input.';
        $confirm_passwordError = true;
    }
    if(!$emailError && !$nameError && !$surNameError && !$passwordError && !$confirm_passwordError){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $addUserQuery = "INSERT INTO `loginDetails` (`email`, `first_name`, `last_name`, `password`) 
        VALUES ('$email', '$surname', '$name', '$hash')";
        if (mysqli_query($conn, $addUserQuery)) {
            header("Location: /phpServer/Landing-page-or-Login-page.php");
            exit;
        }          
    }      
}
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Sign Up">
    <meta name="description" content="">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/phpServer/public/styles/nicepage.css" media="screen">
    <link rel="stylesheet" href="/phpServer/public/styles/Sign-Up.css" media="screen">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.5.0, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lexend+Deca:100,200,300,400,500,600,700,800,900|Inter:100,200,300,400,500,600,700,800,900">
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "/images/websitelogo.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Sign Up">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body class="u-body u-overlap u-xl-mode" data-lang="en"><header class="u-clearfix u-header" id="sec-6a10" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction=""><div class="u-clearfix u-sheet u-sheet-1">
        <a href="Home-page.html" class="Logo u-image u-logo u-image-1" data-image-width="512" data-image-height="88" title="Home page">
          <img src="/images/websitelogo.png" class="u-logo-image u-logo-image-1">
        </a>
        <div class="Buttons Cell u-layout-grid u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-1">
                <a href="Home-page.html" class="Button Home u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-1">Home<br>
                </a>
              </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-2">
                <a href="https://nicepage.com/c/medicine-science-html-templates" class="About Button u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-2">About<br>
                </a>
              </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-3">
                <a href="Landing-page-or-Login-page.html" class="Button My Profile u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-3">My Profile</a>
              </div>
            </div>
          </div>
        </div>
        <a href="/phpServer/Landing-page-or-Login-page.php" class="Button Sign In u-border-2 u-border-grey-75 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-hover-palette-1-light-1 u-radius-50 u-btn-4">Sign in<br>
        </a>
      </div></header>
    <section class="u-clearfix u-section-1" id="sec-ee8f">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="Cell Form u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                <div class="u-container-layout u-valign-bottom-lg u-valign-bottom-xl u-valign-top-sm u-container-layout-1">
                  <img class="u-expanded-width u-image u-image-contain u-image-1" src="/images/image.png" data-image-width="519" data-image-height="281">
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                <div class="u-container-layout u-container-layout-2">
                  <h2 class="Sign Title Up u-custom-font u-text u-text-custom-color-2 u-text-default-lg u-text-default-md u-text-default-xl u-text-1">Sign Up</h2>
                  <div class="u-form u-form-1">
                    <form action="" method="post" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 15px;">
                      <div class="u-form-group u-label-none u-form-group-1">
                        <label for="name" class="u-label">Name</label>
                        <input type="text" placeholder="Name" id="name" name="name" class="u-border-2 u-border-grey-30 u-input u-input-rectangle u-radius-16 u-white <?php if (isset($nameError) && $nameError) { 
                        echo 'incorrect'; }?>" required="">
                        <?php if (isset($nameError) && $nameError) { 
                            echo '<div id="error-message"><span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> ' . $nameErrorMessage . '</div>';
                        }?>
                      </div>
                      <div class="u-form-group u-label-none u-form-group-2">
                        <label for="surname" class="u-label">Surname</label>
                        <input type="text" placeholder="Surname" id="surname" name="surname" class="u-border-2 u-border-grey-30 u-input u-input-rectangle u-radius-16 u-white <?php if (isset($surNameError) && $surNameError) { 
                        echo 'incorrect'; }?>" required="">
                        <?php if (isset($surNameError) && $surNameError) { 
                            echo '<div id="error-message"><span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> ' . $surNameErrorMessage . '</div>';
                        }?>
                      </div>
                      <div class="u-form-group u-label-none u-form-group-3">
                        <label for="email" class="email">Email</label>
                        <input type="email" placeholder="Email" id="text-b490" name="email" class="u-border-2 u-border-grey-30 u-input u-input-rectangle u-radius-16 u-white <?php if (isset($emailError) && $emailError) { 
                        echo 'incorrect'; }?>" required="">
                        <?php if (isset($emailError) && $emailError) { 
                            echo '<div id="error-message"><span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> ' . $emailErrorMessage . '</div>';
                        }?>
                      </div>
                      <div class="u-form-group u-form-name u-label-none u-form-group-4">
                        <label for="password" class="u-label">Password</label>
                        <input type="password" placeholder="Password" id="password" name="password" class="u-border-2 u-border-grey-30 u-input u-input-rectangle u-radius-16 u-white <?php if (isset($passwordError) && $passwordError) { 
                        echo 'incorrect'; }?>" required="">
                        <?php if (isset($passwordError) && $passwordError) { 
                            echo '<div id="error-message"><span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> ' . $passwordErrorMessage . '</div>';
                        }?>
                      </div>
                      <div class="u-form-email u-form-group u-label-none">
                        <label for="validatepassword" class="u-label">Confirm Password</label>
                        <input type="password" placeholder="Re-enter Password" id="validatepassword" name="validatepassword" class="u-border-2 u-border-grey-30 u-input u-input-rectangle u-radius-16 u-white <?php if (isset($confirm_passwordError) && $confirm_passwordError) { 
                        echo 'incorrect'; }?>" required="">
                        <?php if (isset($confirm_passwordError) && $confirm_passwordError) { 
                            echo '<div id="error-message"><span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> ' . $confirm_passwordErrorMessage . '</div>';
                        }?>
                      </div>
                      <div class="u-align-center u-form-group u-form-submit">
                        <input type="submit" value="Sign Up" class="u-border-none u-btn u-btn-round u-btn-submit u-button-style u-custom-color-2 u-custom-font u-radius-19 u-btn-1">
                      </div>
                      <input type="hidden" value="" name="recaptchaResponse">
                      <input type="hidden" name="formServices" value="b5b2f81e2b037e9fd1a2b286493560b8">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-section-2" id="sec-2b9d">
      <img class="Bottom Image u-expanded-width u-image u-image-round u-top-left-radius-50 u-top-right-radius-50 u-image-1" src="/images/image11.png" data-image-width="559" data-image-height="146">
      <h2 class="Bottom Caption u-align-center u-custom-font u-text u-text-body-alt-color u-text-1">Create and Download Your CV in just on​e CLICK !</h2>
    </section>
  
</body></html>

<style>
.incorrect {
    border: 1px #BE0000;
    box-shadow: 0 0 10px #BE0000;
    animation: shake 0.5s;
}

@keyframes shake {
  0% { transform: translateX(0); }
  10% { transform: translateX(-5px); }
  20% { transform: translateX(5px); }
  30% { transform: translateX(-5px); }
  40% { transform: translateX(5px); }
  50% { transform: translateX(-5px); }
  60% { transform: translateX(5px); }
  70% { transform: translateX(-5px); }
  80% { transform: translateX(5px); }
  90% { transform: translateX(-5px); }
  100% { transform: translateX(0); }
}

#error-message {
  color: #BE0000;
  font-size: 12px;
  margin-top: 5px;
  font-weight: bold;
  padding-left: 10px;
}
</style>