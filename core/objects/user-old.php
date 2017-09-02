<?php


    $sucess=false;


   function aType(){
       return ($sucess) ? true : false;
   }
   
   function getProfilePicPath_96($user_id){
       $profilePath = rootDirectory($user_id).'/Profile/thumbs/proPic.png';
       if(file_exists($profilePath)){
           return $profilePath;
       }
       else
       {
           return 'images/proPic.png';
       }
   }
   function getProfilePicPath_32($user_id){
       $profilePath = rootDirectory($user_id).'/Profile/thumbs_32/proPic.png';
       if(file_exists($profilePath)){
           return $profilePath;
       }
       else
       {
           return 'images/icons/menu/menu-user1.png';
       }
   }
   function changePassword($user_id,$password){
       $password = md5($password);
       $query = mysql_query("UPDATE users SET password = '$password' WHERE user_id='$user_id'");
       //return (mysql_result($query, 0)==1) ? true : false;  
   }
   function checkOldPassword($user_id,$old_Password){
       $old_Password = md5($old_Password);       
       $query = mysql_query("SELECT COUNT(user_id) FROM users WHERE user_id = '$user_id' AND password = '$old_Password'");
       return (mysql_result($query, 0)==1) ? true : false;  
   }
   function createAcountDirectory($user_id){
       $rootDir='UserAccounts';
       mkdir($rootDir.'/'.$user_id);
       mkdir($rootDir.'/'.$user_id.'/Uploads');
       mkdir($rootDir.'/'.$user_id.'/Profile');
       mkdir($rootDir.'/'.$user_id.'/Uploads/thumbs');
       mkdir($rootDir.'/'.$user_id.'/Profile/thumbs');
       mkdir($rootDir.'/'.$user_id.'/Profile/thumbs_32');
   }
   function rootDirectory($user_id){
       return("UserAccounts/".$user_id);
   }
   function getUploadDirectory($user_id){
       $rootDir='UserAccounts';
       return($rootDir.'/'.$user_id.'/Uploads');
   }
  
   function getAccountType($email){
       $email = mysql_real_escape_string($email);
       return mysql_result(mysql_query("SELECT account_Type FROM users WHERE email_id = '$email'"),0,'account_Type');           
       
   }
   
   function activate($email,$code){
       $email = mysql_real_escape_string($email);
       $code = mysql_real_escape_string($code);
       
       if(mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email_id = '$email' AND email_code = '$code' AND active = 0"),0)==1){
           mysql_query("UPDATE users SET active=1 WHERE email_id='$email'");
           return true;
       }
       else{
           return false;
       }
   }
   
   function email($to,$subject,$message){
       
       mail($to, $subject, $message,"From: kerurevijay@gmail.com") ;//or die(header("Location: Signup.php?fail"));
       
   }
   function register_User($first_Name,$last_Name,$email,$password){
       
        $first_Name = sanitize($first_Name);
        $last_Name = sanitize($last_Name);
        $email = sanitize($email);
        $password = md5($password);
        $email_code = md5($email + microtime());
        
        mysql_query("INSERT INTO users(first_Name,last_Name,email_Id,password,email_code) VALUES('$first_Name','$last_Name','$email','$password','$email_code')");
        createAcountDirectory(user_id_from_user_name($email));
        email($email,"JustDrop-Activate your account.", "Hello ".$first_Name."\n\nYou need to activate your account , so use the link below : \n\n Link - http://localhost/JustDrop/activate.php?email=".$email."&code=".$email_code."\n\n-JustDrop");
    }
    function logged_In(){
        return (isset($_SESSION['user_id'])) ? true : false;
    }
    function user_Exists($username) {
       
        $username = sanitize($username);
        $query = mysql_query("SELECT COUNT(user_id) FROM users WHERE email_id = '$username'");
        return (mysql_result($query, 0)==1) ? true : false;              
    }
    function email_Exists($email) {
       
        $email = sanitize($email);
        $query = mysql_query("SELECT COUNT(user_id) FROM users WHERE email_id = '$email'");
        return (mysql_result($query, 0)==1) ? true : false;              
    }
    
    function user_Active($username){
        $username = sanitize($username);
        return(mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email_id = '$username' AND active=1"),0)==1) ? true : false;
    }
    function user_id_from_user_name($username){
        $username = sanitize($username);
        return mysql_result(mysql_query("SELECT user_id FROM users WHERE email_id = '$username' "),0,'user_id');
        
    }
    function user_name_from_user_id($userId){
        $userId = sanitize($userId);
        $first_Name = mysql_result(mysql_query("SELECT first_name FROM users WHERE user_id = '$userId' "),0,'first_name');
        $last_Name = mysql_result(mysql_query("SELECT last_name FROM users WHERE user_id = '$userId' "),0,'last_name');
        return ($first_Name.' '.$last_Name);
        
    }
    function login($username,$password){
        $username = sanitize($username);
        $user_id = user_id_from_user_name($username);
        $password = md5($password);
        return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE email_id = '$username' AND password = '$password'"),0)==1) ? $user_id : false;
    }
?>

