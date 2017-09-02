<?php

    // require  './core/functions/admin.php';
    // if(admin_logged_In()===true){
    //     header('Location: adminLogin.php');
    //     exit();
    // }   
    
 ?>

<html>
    <head>
    <meta charset="UTF-8">
    <title>JustDrop</title>
    <link rel="stylesheet" href="css/style.css">
    
       
    </head>
    <body>        
        <!-- TOP BAR -->
	<div id="top-bar">		
		<div class="page-full-width cf">
                    <a href="index.php" id="company-branding" class="fl"><img src="images/justDrop.png" alt="JustDrop" /></a>
                    <ul id="nav" class="fr">				
                        <li class="v-sep"><a href="home.php" class="round button image-left" ><strong>VIJAY K</strong></a>
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

			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Files</h3>                                             
                                                
                                                
                                                <div class="button blue round ic-add image-right fr" id="Upload" >ADD</div>                                                
                                                
                                               
					</div> <!-- end content-module-heading -->
					
					
					<div class="content-module-main">
                                             <form id="frmMain" >
                                           
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
											<option value="option2">Export</option>
											<option value="option3">Archive</option>
										</select>
										
										<a href="javascript:;" class="deleteall round button blue text-upper small-button">Apply to selected</a>	
	
									</td>
									
								</tr>
							
							</tfoot>
							
							<tbody>
                                                            <?php
                                                                /*$path = getUploadDirectory($_SESSION['user_id']);
                                                                $handle = opendir($path);
                                                                while(($file = readdir($handle))!==FALSE){
                        
                                                                    if($file!="." && $file!=".." && $file!="thumbs"){
                                                                        $modiDate = date("d-M-Y, D g:h:s A",filectime($path.'/'.$file));
                                                                        
                                                                        echo '<tr><td><input type="checkbox" class="case"  name="cbFile" style="cursor:pointer;"></td><td>'.$file.'</td><td>'.$modiDate.'</td><td><a href="#" class="download_single table-actions-button ic-table-download"></a>&nbsp;&nbsp;<a href="#" class="table-actions-button ic-table-share"></a>&nbsp;&nbsp;<a href="#" class="delete_single table-actions-button ic-table-delete"></a></td></tr>';
                                                                        //echo "<a class='example-image-link' href='$path.'/'.$file' data-title=\"<a href='$path.'/'.$file'>Download</>\" data-lightbox='example-1'><img class='example-image' height='200' width='300' src='$path.'/'.$file' alt='image-1' /></a>";
                                                                    }
                                                                }
                                                                closedir($handle);*/
                                                            
                                                            ?>
								<tr>
									<td><input type="checkbox"></td>
									<td>Vijay Kerure</td>
									
									<td><a href="#">Vijay@gmail.com</a></td>
									<td>
										<a href="#" class="table-actions-button ic-table-share"></a>
										<a href="#" class="table-actions-button ic-table-delete"></a>
									</td>
								</tr>
	
								<tr>
									<td><input type="checkbox"></td>
									<td>Vijay Kerure</td>
									
									<td><a href="#">Vijay@gmail.com</a></td>
									<td>
										<a href="#" class="table-actions-button ic-table-share"></a>
										<a href="#" class="table-actions-button ic-table-delete"></a>
									</td>
								</tr>                                                           
							
							</tbody>
							
						</table>
                                              </form> <!--end 2nd Form -->    
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->				
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
        <?php include './includes/footer.php'; ?>
    </body>
</html>
