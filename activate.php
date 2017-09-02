<!DOCTYPE html>
<?php
    include 'core/init.php';
    if(logged_In()===true){
        header('Location: index.php');
        exit();
    }   
?>

<html>
    <?php include 'includes/head.php';?>
     <?php include 'includes/topbar.php';?>
    <body>
        <?php
         if(isset($_GET['sucess'])===true && empty($_GET['sucess'])===true){
                echo '<div style="width:30%;margin:100px auto;">'.output_Messages("Thanks for activation , you are sucessfully activated.").'<center><b><a href="login.php" class="button blue round ">CLICK TO LOGIN</a></b></center></div>';
                $_GET['sucess']='';
         }else if(isset($_GET['email'] ,$_GET['code'])===true ){
                
                $email = trim($_GET['email']);
                $code = trim($_GET['code']);
                
                if(email_Exists($email)===false){
                    $errors[] = 'Email-id not exists.';
                }else if(activate($email,$code)===false){
                    $errors[] = 'There is problem in activation or activation link is not valid.'; 
                }
                
                if(empty($errors)===false){
                     echo '<div style="width:30%;margin:100px auto;">'.output_Errors($errors).'</div>';
                }else{
                    header("Location: activate.php?sucess");
                }
            }
        ?>
    </body>
</html>