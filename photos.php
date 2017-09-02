<!DOCTYPE html>
<?php
include 'core/init.php';
    if($user->loggedIn()===false){
       echo '<h1> Sorry,You need to Login First. </h1>';
       header('Location: login.php');
       exit();
    }
    $userName = "vijay kerure";
    //$userName = user_name_from_user_id($_SESSION['user_id']);
?>


<html>
    <head>
    <meta charset="UTF-8">
    <title>JustDrop Photos</title>
    <link rel="stylesheet" href="css/style.css">
        <!-- jQuery & JS files -->    
        <!--  <script src="js/script.js"></script> -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <link rel="stylesheet" href="css/screen.css">
        <link rel="stylesheet" href="css/lightbox.css">
        <script src="js/LightBox/lightbox.js"></script>
       
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
    	<div id="header">		
    		<div class="page-full-width cf">
    	
    			<!-- The logo will automatically be resized to 30px height. -->
    			<!-- <a href="#" id="company-branding-small" class="fl"><img src="images/company-logo.png" alt="Dabba" /></a> -->
    			<form action="#" method="POST" id="search-form" class="fr">
    				<fieldset>
    					<input type="text" id="search-keyword" class="round button blue ic-search image-right" placeholder="Search..." />
    					<input type="hidden" value="SUBMIT" />
    				</fieldset>
    			</form>
    		</div> <!-- end full-width -->	
    	</div> <!-- end header -->
            
        <div id="content">		
    		<div class="page-full-width cf">

    			<div class="side-menu fl">
    				
    				<h3>Uploads</h3>
    				<ul>
                                        <li><a href="home.php">Files</a></li>
                                        <li><a href="Photos.php">Photos</a></li>
                                        <li><a href="#">Shared</a></li>
                                        <li><a href="#">Events</a></li>
    				</ul>
    				
    			</div> <!-- end side-menu -->
    			
    			<div class="side-content fr">
                                <form id="frmMain" >
    				<div class="content-module">
    				
    					<div class="content-module-heading cf">
    					
                                            <h3 class="fl">PHOTOS</h3>                                              
                                                    
    					</div> <!-- end content-module-heading -->
    					
    					
    					<div class="content-module-main">
                                               
                                                <?php
                                                    
                                                    $page = $_SERVER['PHP_SELF'];

                                                    //setting
                                                    $column = 5;

                                                    //directories
                                                    $root = $utility->rootDirectory($_SESSION['user_id']);
                                                    $uploadPath = $utility->getUploadDirectory($_SESSION['user_id']);
                                                    $thumbsPath = $uploadPath.'/thumbs';

                                                    //get albulm

                                                    //$get_album = $_GET['photos'];

                                                    // thumb

                                                    /*   $handle = opendir($base."/Album1/");
                                                      while(($file = readdir($handle))!==FALSE){

                                                      if($file!="." && $file!=".." && $file!="thumbs"){

                                                      createThumbnail($base.'/Album1/'.$file, "$base/$thumbs/$file", 300, 200);
                                                      // echo $base.'/Album1/'.$file.'</br>';
                                                      }
                                                      } */
                                                    // end thumb

                                                    /*if (!$get_album) {
                                                        echo "<b>Select an album : </b><br/>";

                                                        $handle = opendir($base);
                                                        while (($file = readdir($handle)) !== FALSE) {

                                                            if (is_dir($base . "/" . $file) && $file != "." && $file != ".." && $file != "thumbs") {

                                                                echo "<a href='$page?album=$file'>$file</a></br>";
                                                            }
                                                        }
                                                        closedir($handle);
                                                    } else {*/

                                                        if (!is_dir($uploadPath."/" ) ) {

                                                            echo "There is no photos.";
                                                        } else {

                                                            $allowdExt = array('jpg','jpeg','png');
                                                            $handle = opendir($uploadPath . "/");
                                                            while (($file = readdir($handle)) !== FALSE) {

                                                                if ($file != "." && $file != ".." && $file != "thumbs") {
                                                                    $ext  = explode('.', $file);                                                                    
                                                                    $fileExt = strtolower(end($ext));
                                                                    //$fileExt = strtolower(end(explode('.', $file)));
                                                                     if(in_array($fileExt, $allowdExt)===true){
                                                                        echo "<a class='example-image-link' href='$uploadPath/$file' data-title=\"<a href='$uploadPath/$file'>Download</>\" data-lightbox='example-1'><img class='example-image' src='$thumbsPath/$file' height='100' width='150' alt='$file' /></a>";
                                                                     }
                                                                }
                                                            }
                                                            closedir($handle);
                                                        }
                                                    
                                                ?>
                                                    
                                                    
                                                
    					</div> <!-- end content-module-main -->
    				
    				</div> <!-- end content-module -->				
                                </form> <!--end 2nd Form -->      
    			</div> <!-- end side-content -->		
            </div> <!-- end full-width -->          
    	</div> <!-- end content -->
	   <?php include './includes/footer.php'; ?>
    
    </body>
</html>
