<!DOCTYPE html>
<?php
    include 'core/init.php';
    if($user->loggedIn() === true) {
        header('Location: home.php');
        exit();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$firstName = filter_input(INPUT_POST,'first_Name',FILTER_SANITIZE_STRING);
        //$sucess = false;
        $_POST['first_Name']  = filter_input(INPUT_POST,'first_Name',FILTER_SANITIZE_STRING);
        $_POST['last_Name']  = filter_input(INPUT_POST,'last_Name',FILTER_SANITIZE_STRING);
        $errors = array();
            //echo 'Returned Value : '. preg_match("/^[a-z]+$/", $_POST['first_Name']);
     
        if(preg_match("/\\s/",$_POST['first_Name'])== true){
            $errors['first_Name'] = "* Space not allowed.";
        }
        if(preg_match("/\S+/",$_POST['first_Name'])=== 0){
            $errors['first_Name'] = "* First name is required.";
        }
        if(preg_match("/\\s/",$_POST['last_Name'])== true){
            $errors['last_Name'] = "* Space not allowed.";
        }
        if(preg_match("/\S+/",$_POST['last_Name'])=== 0){
            $errors['last_Name'] = "* Last name is required.";
        }
        if(filter_var($_POST['email_Id'],FILTER_VALIDATE_EMAIL)=== false){
            $errors['email_Id'] = "* Email id is not valid.";
        }
        if(strcmp($_POST['email_Id'], $_POST['confirm_Email_Id'])){
            $errors['confirm_Email_Id'] = "* Email-Id do not match.";
        }

        if(preg_match("/.{5,}/",$_POST['password'])=== 0){
            $errors['password'] = "* Password Must Contain at least 5 Characters.";
        }

        if(strcmp($_POST['password'], $_POST['confirm_password'])){
            $errors['confirm_password'] = "* Password do not match.";
        }
        if(count($errors)===0) {
            if($user->emailExists($_POST['email_Id'])===true){
                $errors ['email_Id'] = "Email-id already registered with JustDrop.";
            }
            else {
                $user->registerUser($_POST['first_Name'],$_POST['last_Name'],$_POST['email_Id'],$_POST['password']);
                $_POST['first_Name']=''; 
                $_POST['last_Name']=''; 
                $_POST['email_Id']=''; 
                $_POST['confirm_Email_Id']=''; 

                    //header('Location: accountType.php');
                    //$sucess =  "<script> alert(\"Successfully Registered.\");</script>";
                $_SESSION['RegisterSucess'] =   "You are sucessfully registered with justDrop.<br/>=> Confirmation email code is sent on your registered email-id.<br/>=> For Login first activate the account.<br/>=> Select your account type(default is STARTER).";
            }

        }
    }

?>

<html>
<?php include 'includes/head.php';?>
<body>
 <?php include 'includes/topBarSignup.php';?>       
 <?php include 'includes/headerSignUp.php';?>       
 <!-- MAIN CONTENT -->
 <div id="content" class="cf">	
    <div id="slider" class="fl slider ">
        <img src="images/slider/blueWorld.png"  />
    </div>
    <form action="signup.php" method="POST" id="signup-form" class="fr cf" >		
     <fieldset>
        <?php if(isset($_SESSION['RegisterSucess']) === true && empty($_SESSION['RegisterSucess'])===false){echo $utility->output_infoMessage($_SESSION['RegisterSucess']);$_SESSION['RegisterSucess']='';}?>
        <p>
            <label><strong>Name</strong></label>
            <input type="text" placeholder="First"  name="first_Name"  id="first_Name" class="round full-width-input-small" value="<?php if(isset($_POST['first_Name'])){echo $_POST['first_Name'];} ?>" autofocus/>
            <input type="text" placeholder="Last"   name="last_Name" id="last_Name" class="round full-width-input-small" value="<?php if(isset($_POST['last_Name'])){ echo $_POST['last_Name'] ;} ?>" autofocus />
            <?php if(isset($errors['first_Name'])){ echo "<strong class=\" valError fl\">".$errors['first_Name']."</strong>";}
            if(isset($errors['last_Name'])){ echo "<strong class=\"fr valError \">".$errors['last_Name']."</strong>";}?>

        </p>

        <p>
            <label for="email_Id" class="cb"><strong>Email Id</strong></label>
            <input type="text" placeholder="E-mail Address"  name="email_Id" id="email_Id" class="round full-width-input" value="<?php if(isset($_POST['email_Id'])){echo $_POST['email_Id'] ;} ?>" autofocus />
            <?php if(isset($errors['email_Id'])){ echo "<strong class=\" valError \">".$errors['email_Id']."</strong>";}?>

        </p>

        <p>
            <label for="confirm_Email_Id"><strong>Confirm email id</strong></label>
            <input type="text" placeholder="Confirm E-mail Address"  name="confirm_Email_Id" id="confirm_Email_Id" class="round full-width-input" value="<?php if(isset($_POST['confirm_Email_Id'])){echo $_POST['confirm_Email_Id'] ;} ?>" autofocus />
            <?php if(isset($errors['confirm_Email_Id'])){ echo "<strong class=\" valError \">".$errors['confirm_Email_Id']."</strong>";}?>
        </p>
        <p>
            <label for="password"><strong>Password</strong></label>
            <input type="password" placeholder="Password"  name="password" id="password" class="round full-width-input" />
            <?php if(isset($errors['password'])){ echo "<strong class=\" valError \">".$errors['password']."</strong>";}?>
        </p>
        <p>
            <label for="confirm_password"><strong>Confirm password</strong></label>
            <input type="password" placeholder="Confirm Password"  name="confirm_password" id="confirm_password" class="round full-width-input" />
            <?php if(isset($errors['confirm_password'])){ echo "<strong class=\" valError \">".$errors['confirm_password']."</strong>";}?>
        </p>
        <input type="submit" class="button round blue ic-right-arrow fr" value="NEXT STEP"/>

        <!-- <?php/* if(isset($_SESSION['RegisterSucess'])==true && empty($_SESSION['RegisterSucess'])===false){ echo '<div style="margin-top:100px;">'.output_infoMessage($_SESSION['RegisterSucess']).'</div>';$_SESSION['RegisterSucess']='';}*/?>-->
    </fieldset>                    
    <br/>
</form>		
</div> <!-- end content -->        
<?php include 'includes/footer.php'?>
</body>
</html>
