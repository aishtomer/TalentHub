<?php
if (isset($_COOKIE['user'])) {
  header('Location: /phpServer/Home-page.php');
  exit;
}

require "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $checkLoginQuery = $conn->query("SELECT * FROM loginDetails WHERE email = '$email'");
    $numRow = mysqli_num_rows($checkLoginQuery);
    
    if ($numRow == 1) {
        $emailError = false;
        $user = mysqli_fetch_assoc($checkLoginQuery);
        if (password_verify($password, $user["password"])) {
            $passwordError = false;
            setcookie('user', $user["user_id"], time() + 86400 * 30, '/');
            header("Location: Home-page.php");
            exit;
        } else {
            $passwordError = true;
            $passwordErrorMessage = "Password Incorrect";
        }
    } else {
        $emailError = true;
        $emailErrorMessage = "Email does not exist.";
    }    
}
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Sign in, ​Tell people more about your professional life​​">
    <meta name="description" content="">
    <title>Landing page or Login page</title>
    <link rel="stylesheet" href="/phpServer/public/styles/nicepage.css" media="screen">
    <link rel="stylesheet" href="/phpServer/public/styles/Landing-page-or-Login-page.css" media="screen">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <script class="u-script" type="text/javascript" src="/phpServer/public/scripts/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="/phpServer/public/scripts/nicepage.js" defer=""></script>
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
    <meta property="og:title" content="Landing page or Login page">
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
        <a href="/phpServer/Sign-Up.php" class="Button Sign Up u-border-2 u-border-grey-75 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-hover-palette-1-light-1 u-radius-50 u-btn-4">Sign up<br>
        </a>
      </div></header>
    <section class="u-clearfix u-section-1" id="sec-b9d7">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="Cell Form u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                <div class="u-container-layout u-valign-bottom-xl u-container-layout-1">
                  <img class="Caption Image u-absolute-hcenter-xs u-expanded u-image u-image-contain" src="/images/image.png" data-image-width="519" data-image-height="281">
                </div>
              </div>
              <div class="u-align-center u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                <div class="u-container-layout u-container-layout-2">
                  <h2 class="In Sign Title u-custom-font u-text u-text-custom-color-2 u-text-default u-text-1">Sign in</h2>
                  <div class="Form In Sign u-expanded-width-md u-form u-form-1">
                    <form action="" method="post" class="u-clearfix u-form-spacing-27 u-form-vertical u-inner-form" name="form" style="padding: 32px;">
                      <div class="u-form-email u-form-group u-label-none">
                        <label for="email" class="u-label">Email</label>
                        <input type="email" placeholder="Email address" id="email" name="email" class="u-border-2 u-border-grey-75 u-input u-input-rectangle u-radius-16 u-white <?php if (isset($emailError) && $emailError) { 
                        echo 'incorrect'; }?>" required="">
                        <?php if (isset($emailError) && $emailError) { 
                            echo '<div id="error-message"><span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> ' . $emailErrorMessage . '</div>';
                        }?>
                      </div>
                      <div class="u-form-group u-form-name u-label-none">
                        <label for="password" class="u-label">Password</label>
                        <input type="password" placeholder="Password" id="password" name="password" class="u-border-2 u-border-grey-75 u-input u-input-rectangle u-radius-16 u-white <?php if (isset($passwordError) && $passwordError) { 
                        echo 'incorrect'; }?>" required="">
                        <?php if (isset($passwordError) && $passwordError) { 
                            echo '<div id="error-message"><span class="error-icon"><i class="fas fa-exclamation-triangle"></i></span> ' . $passwordErrorMessage . '</div>';
                        }?>
                      </div>
                      <div class="u-form-checkbox u-form-group u-label-none u-form-group-3">
                        <input type="checkbox" id="checkbox-5fdf" name="rememberme" value="On" class="u-field-input">
                        <label for="checkbox-5fdf" class="u-block-c570-19 u-field-label" style="">Remember Me</label>
                      </div>
                      <div class="u-align-center u-form-group u-form-submit u-label-none">
                        <input type="submit" value="Login" class="u-border-none u-btn u-btn-round u-btn-submit u-button-style u-custom-color-2 u-custom-font u-radius-16 u-btn-1">
                      </div>
                    </form>
                  </div>
                  <a href="https://nicepage.com/wysiwyg-html-editor" class="Forgot Link Password u-border-1 u-border-active-palette-2-base u-border-hover-palette-1-base u-border-no-left u-border-no-right u-border-no-top u-btn u-button-style u-custom-font u-none u-text-palette-1-base u-btn-2">Forgot password?</a>
                  <a href="/phpServer/Home-page.php" class="Button Guest u-border-none u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-radius-16 u-btn-3" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">As Guest<span style="font-weight: 700;"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-2" id="sec-167e">
      <img class="Bottom Caption u-expanded-width u-image u-image-round u-top-left-radius-50 u-top-right-radius-50 u-image-1" src="/images/image11.png" data-image-width="559" data-image-height="146">
      <h2 class="Caption u-align-center u-custom-font u-text u-text-body-alt-color u-text-1"> Tell people more about your professional life<span style="font-weight: 700;">
          <span style="font-weight: 400;"></span>
        </span>
      </h2>
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