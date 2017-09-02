<!DOCTYPE html>

<?php
include 'core/init.php';
    if($user->loggedIn()===false){
       echo '<h1> Sorry,You need to Login First. </h1>';
       header('Location: login.php');
       exit();
    }
    
    $userName = $user->usernameFromUserId($_SESSION['user_id']);

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
                                <li><a href="accountSetting.php">User Settings</a></li>
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
                            <li><a href="accountSetting.php" class="active-tab">Account Setting</a></li>
                            <li><a href="changePassword.php">Change Password</a></li>
			</ul> <!-- end tabs -->
			
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
        
    </body>
</html>