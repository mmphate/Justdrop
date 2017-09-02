<!DOCTYPE html>

<?php
    include 'core/init.php';
    if($user->loggedIn() === false){
       //echo '<h1> Sorry,You need to Login First. </h1>';
       header('Location: login.php');
       exit();
    }
    
    $userName = $user->usernameFromUserId($_SESSION['user_id']);

?>


<html>
    <?php include 'includes/head.php';?>

    <body>
        
        <div id="dialog-modal"  style="font-size: 62.5%;" title="Upload Files">
            <p style="font-size:1.3em;">Select Files</p><br/>

            <form id="frmUpload" style="font-size:1em;" name="frmUpload" action="" method="POST" enctype="multipart/form-data">
                <fieldset>
                
              
                <!-- FILE UPLOADER -->
                    <input type="file" name="filesUpload[]" multiple="">
                    <input type="submit" id="btnSubmit" class="button blue round ic-upload image-right fr" value="Upload">
                    <br/><br/><br/>
                <!-- FileUpload with multiFileUploader
                    <div id="mulitplefileuploader">Upload</div>
                    <div id="status"></div>
                -->
                <?php 
    
    
                    //include 'imageCreate.php';
                    
                    if(isset($_FILES['filesUpload'])===true) {

                        $files = $_FILES['filesUpload'];
                        $uploadPath = $utility->getUploadDirectory($_SESSION['user_id']);
                        $thumbsPath = $uploadPath.'/thumbs';
                        $allowdExt = array('jpg','jpeg','png');
                        for($x=0;$x < count($files['name']);$x++){
                            $name = $files['name'][$x];
                            $tmp_name = $files['tmp_name'][$x];
                            $fileSize = $files['size'][$x];
                            $fileExt = strtolower(end(explode('.', $name)));
                            
                            $limit = 7340032;
                            $fz = $fileSize / 1024;
                            
                            if($fileSize > $limit){
                                
                                if($fz<1024){
                                    echo '<br/>'.$utility->output_errorMessage("$fz KB Size is too large.").'<br/>';                            
                                }else{
                                    $fz = $fz/1024;
                                    echo '<br/>'.$utility->output_errorMessage("$fz MB Size is too large.").'<br/>';                            
                                }
                                continue;                            
                            }
                            else
                            {
                                $fz = $fz/1024;
                                move_uploaded_file($tmp_name,  $utility->getUploadDirectory($_SESSION['user_id']).'/'.$name); 
                                if(in_array($fileExt, $allowdExt)===true){
                                    $utility->createThumbnail($uploadPath.'/'.$name, $thumbsPath.'/'.$name, 150, 100);
                                }
                                echo '<br/>'.$utility->output_infoMessage("$name is uploaded.").' Size:'.$fz.' MB <br/>';                            
                            }
                        
                        }     
                    }     ?>            
                </fieldset>
            </form>
        </div>
        
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
    			<!-- <form action="#" method="POST" id="search-form" class="fr">
    				<fieldset>
    					<input type="text" id="search-keyword" class="round button blue ic-search image-right" placeholder="Search..." />
    					<input type="hidden" value="SUBMIT" />
    				</fieldset>
    			</form> -->
    		</div> <!-- end full-width -->	
    	</div> <!-- end header -->
            
        <div id="content">		
	           <div class="page-full-width cf">

			<div class="side-menu fl">
				
				<h3>Uploads</h3>
				<ul>
					<li><a href="home.php">Files</a></li>
					<li><a href="photos.php">Photos</a></li>
					<li><a href="#">Shared</a></li>
					<li><a href="#">Events</a></li>
				</ul>
				
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
                            <form id="frmMain" >
				<div class="content-module">				
					<div class="content-module-heading cf">					
						<h3 class="fl">Files</h3>
                        <div class="button blue round ic-add image-right fr" id="Upload" style="margin: 5px;">ADD</div>                                              
					</div> <!-- end content-module-heading -->
					
					
					<div class="content-module-main">
                                           
						<table>						
							<thead>						
								<tr>
                                    <th><input type="checkbox" id="table-select-all" style="cursor:pointer;"></th>
									<th>Filename</th>
									<th>Modified</th>									
									<th>Actions</th>
								</tr>
							
							</thead>	
							<tfoot>							
								<tr>								
									<td colspan="5" class="table-footer">									
										<label for="table-select-actions">With selected:</label>	
										<select id="table-select-actions">
											<option value="option1">Delete</option>											
										</select>										
										<a href="javascript:;" class="deleteall round button blue text-upper small-button">Apply to selected</a>	
									</td>									
								</tr>							
							</tfoot>							
							<tbody>
                                <?php

                                    $path = $utility->getUploadDirectory($_SESSION['user_id']);                                    
                                    $handle = opendir($path);
                                    while(($file = readdir($handle))!==FALSE){

                                        if($file!="." && $file!=".." && $file!="thumbs"){
                                            $modiDate = date("d-M-Y, D g:h:s A",filectime($path.'/'.$file));
                                            
                                            echo '<tr><td><input type="checkbox" class="case"  name="cbFile" style="cursor:pointer;"></td><td>'.$file.'</td><td>'.$modiDate.'</td><td><a href="#" class="download_single table-actions-button ic-table-download"></a>&nbsp;&nbsp;<a href="#" class="table-actions-button ic-table-share"></a>&nbsp;&nbsp;<a href="#" class="delete_single table-actions-button ic-table-delete"></a></td></tr>';
                                            //echo "<a class='example-image-link' href='$path.'/'.$file' data-title=\"<a href='$path.'/'.$file'>Download</>\" data-lightbox='example-1'><img class='example-image' height='200' width='300' src='$path.'/'.$file' alt='image-1' /></a>";
                                        }
                                    }
                                    closedir($handle);
                                
                                ?>
							
							</tbody>
							
						</table>
                                            
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->				
                            </form> <!--end 2nd Form -->      
			</div> <!-- end side-content -->		
	           </div> <!-- end full-width -->	       
        </div> <!-- end content -->

        <?php include './includes/footer.php'; ?>
    </body>
</html>
