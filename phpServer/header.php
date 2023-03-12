<?php require 'conn.php';
if (isset($_COOKIE['user'])) {
    $isLogin = true;
    $user_id = $_COOKIE["user"];
}else{
    $isLogin = false; 
}
?>
<link rel="stylesheet" href="/phpServer/public/styles/nicepage.css" media="screen">
<link rel="stylesheet" href="/phpServer/public/styles/Landing-page-or-Login-page.css" media="screen">
<header class="u-clearfix u-header" id="sec-6a10" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction=""><div class="u-clearfix u-sheet u-sheet-1">
    <a href="/phpServer/Home-page.php" class="Logo u-image u-logo u-image-1" data-image-width="512" data-image-height="88" title="Home page">
        <img src="/images/websitelogo.png" class="u-logo-image u-logo-image-1">
    </a>
    <div class="Buttons Cell u-layout-grid u-list u-list-1">
        <div class="u-repeater u-repeater-1">
            <div class="u-container-style u-list-item u-repeater-item">
                <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-1">
                    <a href="Home-page.php" class="Button Home u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-1">Home<br></a>
                </div>
            </div>
            <div class="u-container-style u-list-item u-repeater-item">
                <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-2">
                    <a href="/phpServer/About.php" class="About Button u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-2">About<br></a>
                </div>
            </div>
            <?php
                if($isLogin){
                    $result = $conn->query("SELECT * FROM userDetails WHERE user_id = $user_id");
                    echo '
                        <div class="u-container-style u-list-item u-repeater-item">
                            <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-3">';
                    if ($result->num_rows > 0) {
                        echo '<a href="editProfile.php?id=' . $user_id . '" class="Button My Profile u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-3">My Profile</a>';
                    } else {
                        echo '<a href="addProfile.php?id=' . $user_id . '" class="Button My Profile u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-3">My Profile</a>';
                    }
                    echo '
                            </div>
                        </div>

                        </div>     
                        </div>
                        <a href="/phpServer/logOut.php" class="Button Sign Up u-border-2 u-border-grey-75 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-hover-palette-1-light-1 u-radius-50 u-btn-4">Log Out<br>
                        </a>';
                }else{
                    echo'
                    <div class="u-container-style u-list-item u-repeater-item">
                        <div class="u-container-layout u-similar-container u-valign-bottom u-container-layout-3">
                        <a href="#" class="Button My Profile u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-custom-item u-none u-text-body-color u-btn-3"></a>
                        </div>
                     </div>
                    </div>
                    </div>
                    <a href="Sign-Up.php" class="Button Sign Up u-border-2 u-border-grey-75 u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-hover-palette-1-light-1 u-radius-50 u-btn-4">Sign up</a>
                    ';
                }
            ?>
    </div>
</header>
