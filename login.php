<!DOCTYPE html>
<!--
Website : justDrop.com
Developers : Vijay Kerure
-->
<?php
    include 'core/init.php';    
    if($user->loggedIn()===true){
        header('Location: home.php');
        exit();
    } else {

        if(empty($_POST) === false) {

            $username = $_POST['txtUserName'];
            $password = $_POST['txtPassword'];
            
            if(empty($username)===true || empty($password)===true) {
                $errors[] = 'You need to enter your username & password.';
            //} else if($user->isUserActive($username) == false){
            //     $errors[] = 'You haven\'t activated your account.';
            } else {                
                $login = $user->login($username,$password);
                if($login) {
                    $_SESSION['user_id'] = $login;
                    header('Location: home.php');                    
                    exit();
                }
                else {
                    $errors[] = 'Username or password is incorrect.';                
                }           
            }        
        }
    }
?>
<html>    
    <?php include 'includes/head.php';?>    
    <body>
        <?php include 'includes/topBarLogin.php';?>        
        <?php include 'includes/headerLogin.php';?>

    	<!-- main content -->    
        <div id="content" class="cf">
            <form method="POST" id="login-form" class=" cf">
                <fieldset>
                   <?php
                        if(isset($errors) && count($errors) > 0) { 
                           echo '<p style="padding: 0.833em 0.833em 0.833em 3em; 
                                margin-bottom: 0.833em;
                                background: #fde8e4 url(\'./images/icons/message-boxes/error.png\') no-repeat 0.833em center;
                                border: 1px solid #e6bbb3;
                                color: #cf4425;">'. $errors[0] .'</p>';
                        }
                   ?>
                    
                    <center><img src="images/user.png"/></center>
                    <p>
                        <label for="txtUserName"><strong>EMAIL ID</strong></label>
                        <input type="text" placeholder="E-mail Address" required="" id="txtUserName" name="txtUserName" class="round full-width-input" autofocus />
                    </p>

                    <p>
                        <label for="txtPassword"><strong>PASSWORD</strong></label>
                        <input type="password" placeholder="Password" required="" id="txtPassword" name="txtPassword" class="round full-width-input" />
                    </p>

                    <p><a href="#">Forgot password ?</a>.</p>                              

                    <input type="submit" class="button round blue image-right ic-right-arrow" id="btnLogin" value="LOGIN"/>
                </fieldset>                    
                </br>
                <?php 
                              
                    if(isset($_SESSION['error_Message'])===true) {
                        echo $_SESSION['error_Message'];
                        $_SESSION['error_Message']='';                        
                    }
               
                ?>  
            </form>		
    	</div> <!-- end content -->       
        
        <?php include 'includes/footer.php';?>
    </body>
</html>