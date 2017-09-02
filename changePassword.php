<!DOCTYPE html>

<?php
include 'core/init.php';
if($user->loggedIn() === false){
   echo '<h1> Sorry,You need to Login First. </h1>';
   header('Location: login.php');
   exit();
}

$userName = $user->usernameFromUserId($_SESSION['user_id']);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $_POST['old_Pass']  = filter_input(INPUT_POST,'old_Pass',FILTER_SANITIZE_STRING);
    $_POST['new_Pass']  = filter_input(INPUT_POST,'new_Pass',FILTER_SANITIZE_STRING);
    $errors = array();

    if(empty($_POST['old_Pass'])){
        $errors['old_password'] = "* Enter old password";
    }
    else
    {
        
        if(!$user->checkOldPassword($_SESSION['user_id'], $_POST['old_Pass'])){
            $errors['old_password'] = "* Old Password do not match.";
        }
    }
    if(preg_match("/.{5,}/",$_POST['new_Pass'])=== 0){
        $errors['new_password'] = "* New password must contain at least 5 characters.";
    }
    if(strcmp($_POST['new_Pass'], $_POST['confirm_Pass'])){
        $errors['confirm_password'] = "* New password & confirm password do not match.";
    }

    if(count($errors)===0)
    {       
        $user->changePassword($_SESSION['user_id'], $_POST['new_Pass']);
        $_POST['old_Pass'] ='';
        $_POST['new_Pass'] ='';
        $_POST['confirm_Pass'] ='';
        $_SESSION['sucess'] = 'Password changed sucessfully.';           

    }

}
?>


<html>
<head>
    <meta charset="UTF-8">
    <title>JustDrop</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery & JS files -->       

    <script src="js/jquery-1.10.2.min.js"></script>
</head>
<body>
    <!-- TOP BAR -->
    <div id="top-bar">		
        <div class="page-full-width cf">
            <a href="index.php" id="company-branding" class="fl"><img src="images/justDrop.png" alt="JustDrop" /></a>
            <ul id="nav" class="fr">
            <li class="v-sep"><a href="home.php" class="round button image-left" style="background: url('<?php echo $utility->getProfilePicPath_32($_SESSION['user_id']); ?>') no-repeat left;"><strong><?php echo ucwords($userName); ?></strong></a>
                <ul>
                    <li><a href="profile.php">My Profile</a></li>                    
                    <li><a href="changePassword.php">Change Password</a></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul> 
            </li>			
            <li><a href="logout.php" class="round button menu-logoff image-left">Log out</a></li>				
            </ul> <!-- end nav -->				
        </div> <!-- end full-width -->		                
    </div> <!-- end top-bar -->
        
    <!-- HEADER -->
    <div id="header-with-tabs">
      <div class="page-full-width cf">
            <ul id="tabs" class="fl">
            <li><a href="profile.php" class="dashboard-tab">My Profile</a></li>    
            <li><a href="changePassword.php" class="active-tab">Change Password</a></li>
            </ul> <!-- end tabs -->
        </div> <!-- end full-width -->
    </div> <!-- end header -->

    <div id="content">
        <div class="page-full-width cf">
            <div class="half-size-column-password center-page">

            <div class="content-module">					
                <div class="content-module-heading cf">
                    <h3> Change Password </h3>
                </div>
                <div class="content-module-main">

                    <form action="changePassword.php" method="POST" id="change-Password">
                        <fieldset>
                            <p>
                                <label for="old_Pass" class="cb"><strong>Old Password : </strong>
                                    <input type="password" placeholder="Old password"  name="old_Pass"  id="old_Pass" class="round full-width-input-password fr" />
                                </label>
                                <?php if(isset($errors['old_password'])){ echo "<strong class=\" valError \">".$errors['old_password']."</strong>";}?>
                            </p>
                            <p>
                                <label><strong>New Password : </strong>
                                    <input type="password" placeholder="New password"   name="new_Pass" id="new_Pass" class="round full-width-input-password fr" />
                                </label>

                            </p>
                            <p>
                                <label><strong>Confirm Password : </strong>
                                    <input type="password" placeholder="Confirm password"   name="confirm_Pass" id="confirm_Pass" class="round full-width-input-password fr" />
                                </label> 

                            </p></br>
                            <p>
                                <?php if(isset($errors['new_password'])){ echo "<strong class=\" valError \">".$errors['new_password']."</strong>";}?>
                                <?php if(isset($errors['confirm_password'])){ echo "<strong class=\" valError \">".$errors['confirm_password']."</strong>";}?>
                            </p>
                            <div class="stripe-separator"></div>
                            <!-- <b><a href="" class="button round blue fr">Change Password</a></b> -->
                            <input type="submit" class="small-button round blue ic-right-arrow fr" value="Change Password"/>
                            <p><?php 
                                if(isset($_SESSION['sucess'])==true && empty($_SESSION['sucess'])===false) { 
                                    echo '<div style="margin-top:70px;">
                                            <p style="padding: 0.833em 0.833em 0.833em 3em; margin-bottom: 0.833em; 
                                                background: #e5f5f9 url(\'./images/icons/message-boxes/information.png\') no-repeat 0.833em center;
                                                border: 1px solid #cae0e5;color: #5a9bab;">'. $_SESSION['sucess'] .
                                            '</p>
                                        </div>';
                                        $_SESSION['sucess']="";
                                }?>
                        </fieldset>
                    </form>

                </div> <!-- end content-module-main -->

            </div><!--end content-module-->
            </div><!--end half-size-column-->
        </div><!-- end page-full-width-->
    </div><!--end content-->

</body>
</html>