<!DOCTYPE html>
<!--
Website : justDrop.com
developers : Vijay Kerure,Amol Patil.
-->
<?php
   
    session_start();
    mysql_connect('localhost','root','') or die(mysql_error());
    mysql_select_db('justdrop');   
    
    require  './core/functions/admin.php';
    
    
    $errors = array();
    if(empty($_POST)===false)
    {
        $username = $_POST['txtUserName'];
        $password = $_POST['txtPassword'];
        if(empty($username)===true || empty($password)===true){
            $errors[] = 'You need to enter your username & password.';
        }
        else if(admin_Exists($username)===false){
            $errors[] = 'The username does not exists.';
        
        }else{
            
            $loginAdmin = loginAdmin($username,$password);
            if($loginAdmin===false){
                $errors[] = 'Username/password combination is incorrect.';
            }
            else{
                $_SESSION['userName'] = $loginAdmin;
                header('Location: adminHome.php');
                //echo 'Successfully logged in.';
                exit();               
            }           
        }        
    }  
   if(empty($errors)===FALSE){
       $_SESSION['error_Message' ] =  output_Errors($errors);
      // header('Location: adminLogin.php');
       //exit();
   }

    //include 'core/functions/admin.php';
    if(admin_logged_In()===true){
        header('Location: adminHome.php');
        exit();
    }   
    
    
    
    
?>
<html>
    
    <?php include 'includes/head.php';?>
    <body>
        <?php include 'includes/topBarLogin.php';?>        
        <?php include 'includes/headerLogin.php'?>
	<!-- MAIN CONTENT -->
        <div id="content" class="cf">            
            <form action="adminLogin.php" method="POST" id="login-form" class=" cf">		
                <fieldset>
                   
                    <?php if(isset($_SESSION['RegisterSucess']) === true && empty($_SESSION['RegisterSucess'])===false){echo output_infoMessage($_SESSION['RegisterSucess']);$_SESSION['RegisterSucess']='';}?>
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
                              
                    if(isset($_SESSION['error_Message'])===true)
                    {
                        echo $_SESSION['error_Message'];
                        $_SESSION['error_Message']='';
                        
                    }
               
                ?>  
            </form>		
	</div> <!-- end content -->        
        <?php include 'includes/footer.php';?>
    </body>
</html>
