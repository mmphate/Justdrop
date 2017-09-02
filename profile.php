<!DOCTYPE html>

<?php
    include 'core/init.php';
    if($user->loggedIn()===false){
       ///echo '<h1> Sorry,You need to Login First. </h1>';
       header('Location: login.php');
       exit();
    }
    
    $userName = $user->usernameFromUserId($_SESSION['user_id']);

    // include 'imageCreate.php';
    if (isset($_FILES['filesUpload']) === true) {
        
        $files = $_FILES['filesUpload'];

        $rootPath = $utility->rootDirectory($_SESSION['user_id']);
        $profilePath = $rootPath . '/profile';
        $thumbsPath = $profilePath . '/thumbs/';
        $thumbsPath32 = $profilePath . '/thumbs_32/';
            
        $allowdExt = array('jpg','jpeg','png');
        $name = $files['name'];
        $tmp_name = $files['tmp_name'];
        $fileSize = $files['size'];
        $ext = explode('.', $name);
        $fileExt = strtolower(end($ext));
        $limit = 3145728;
        $fz = $fileSize / 1024;
        if(in_array($fileExt, $allowdExt)===FALSE){
            echo '<script>alert("Only image files are allowed.\n\nAllowd Extenctions(jpg,jpeg,png)");</script>';
        }
        else{
            if ($fileSize > $limit) {

            if ($fz < 1024) {
                echo '<script>alert("' . $fz . ' KB size is to large.\nMAX file size is 3MB");</script>';
                //echo '<br/>' . output_errorMessage("$fz KB Size is too large.") . '<br/>';
            } else {
                $fz = $fz / 1024;
                echo '<script>alert("' . $fz . ' MB size is to large.\nMAX file size is 3MB");</script>';
                //echo '<br/><script>alert("' . output_errorMessage("$fz MB Size is too large.") . '");</script><br/>';
            }
            } else {
            $fz = $fz / 1024;
            move_uploaded_file($tmp_name, $profilePath . '/proPic.' . $fileExt);
            $utility->createThumbnail($profilePath . '/proPic.' . $fileExt, $thumbsPath . '/proPic.png' , 96, 96);
            $utility->createThumbnail($profilePath . '/proPic.' . $fileExt, $thumbsPath32 . '/proPic.png' , 32, 32);
            //echo '<br/>' . output_infoMessage("$name is uploaded.") . ' Size:' . $fz . ' MB <br/>';
            }
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
                            <li><a href="profile.php" class="active-tab dashboard-tab">My Profile</a></li>                            
                            <li><a href="changePassword.php">Change Password</a></li>
			</ul> <!-- end tabs -->
			
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
        
        <!--MAIN CONTENT-->
        <div id="content">
            <div class="page-full-width cf">
                <div class="half-size-column-profile center-page">
                <div class="content-module cf">			
                    <div class="content-module-heading cf">				
                        <h3 class="fl" >MY PROFILE</h3>				
                    </div> <!-- end content-module-heading -->			
                    
                    <div class="content-module-main">                        
                        <div class="half-size-column fl"> 
                            <form>
                                <fieldset >
                                    <p>
                                        <strong>Name: </strong>
                                        <input type="text" placeholder="First"  name="first_Name"  id="first_Name" class="round" style="width:40%;height:1.2em;" value="" autofocus/>
                                        <input type="text" placeholder="Last"   name="last_Name" id="last_Name" class="round " style="width:40%;height:1.2em; " value="" autofocus />
                                    </p>

                                    <p>
                                        <strong>&nbsp;&nbsp;&nbsp;DOB: </strong>
                                        <input type="text" placeholder="Mobile"  name="first_Name"  id="first_Name" class="round" style="width:40%;height:1.2em;" value="" autofocus/>
                                        <strong>&nbsp;GENDER: </strong>
                                        <select id="dropdown-actions">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                    </p>
                                    <p>
                                        <strong>Mobile: </strong>
                                        <input type="text" placeholder="Mobile"  name="first_Name"  id="first_Name" class="round" style="width:27%;height:1.2em;" value="" autofocus/>
                                    </p> 
                                    <p>
                                    </p> 
                                    <p>                                        
                                        <input type="submit" class="button blue ic-download" value="Save"/>
                                    </p>

                                </fieldset>                            
                            </form>                        
                        </div>         
                        <div class="half-size-column-profile-pic fr"> 
                            <form action="" method="POST" id="frmProfilePicUpload"  enctype="multipart/form-data">
                                <!--Profile picture div-->
                                <div style="border:1px solid #eeefef;height:128px;width: 128px;padding: 10px; ">
                                    <img class="" src="<?php echo $utility->getProfilePicPath_96($_SESSION['user_id']);?>" style="padding: 10px;" alt="Profile Picture"/>
                                
                                </div><!--end Profile picture-->
                                <input type="file" name="filesUpload">
                                <input type="submit" style="margin:10px auto 10px auto;" id="btnSubmit" class="small-button blue round ic-upload image-right fl" value="Upload">                                
                            </form>                           
                                                      
                        </div>                         
                    </div>    
                    </div>
                </div>
            </div>
        </div>        
    </body>
</html>