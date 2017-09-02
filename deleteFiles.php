
<?php
    include 'core/init.php';
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest')
    {
        if(isset($_POST['fileName']))
        {
           $fileToDelete = $_POST['fileName'];
            //echo $_POST['name'].' File Deleted Sucessfully';
            //print_r($_POST);
			if(file_exists($utility->getUploadDirectory($_SESSION['user_id']).'/'.$fileToDelete)){
				$result = unlink($utility->getUploadDirectory($_SESSION['user_id']).'/'.$fileToDelete);
				
			}
			if(file_exists($utility->getUploadDirectory($_SESSION['user_id']).'/thumbs/'.$fileToDelete)){
				
				unlink($utility->getUploadDirectory($_SESSION['user_id']).'/thumbs/'.$fileToDelete);
			}
            
            if($result)
            {
                echo $fileToDelete.' is deleted sucessfully.';
            }
            else
            {
                echo 'Error occured during deleting  file.';
            }
        }
    
        if(isset($_POST['fileDownload'])){
           $fileToDownload = $_POST['fileDownload'];
           
            //echo $_POST['name'].' File Deleted Sucessfully';
            //print_r($_POST);
			if(file_exists($utility->getUploadDirectory($_SESSION['user_id']).'/'.$fileToDownload)){
                            $path = $utility->getUploadDirectory($_SESSION['user_id']).'/'.$fileToDownload;
				//$result = unlink(getUploadDirectory($_SESSION['user_id']).'/'.$fileToDelete);
                             //echo $fileToDownload.' is deleted sucessfully.';
                             //echo '<a href="'.$path.'">Download</a>';
                            echo $path;
			}
            
        }
    }
    else{
        echo 'Not Accesable,Page NOT Found.';
    }
?>