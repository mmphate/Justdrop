<?php
    //print_r( output_Errors($errors));
   /// $_SESSION['error_Message' ] =  output_Errors($errors);
    //$callingPage = $_SERVER['HTTP_REFERER'];
      // echo 'alert($callingPage);';
     // header('Location: adminLogin.php');
      


    function admin_logged_In(){
        return (isset($_SESSION['userName'])) ? true : false;
    }
    function loginAdmin($username,$password){
        $username = sanitize($username);
        $user_id = user_id_from_user_name($username);
        $password = md5($password);
        return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM admin WHERE userName = '$username' AND password = '$password'"),0)==1) ? $user_id : false;
    }
    function user_id_from_user_name($username){
        $username = sanitize($username);
        return mysql_result(mysql_query("SELECT user_id FROM admin WHERE userName = '$username' "),0,'user_id');
        
    }
    function output_Errors($errors){
        $error = '';
        foreach($errors as $error){
            $error = '<p style="padding: 0.833em 0.833em 0.833em 3em; 
            margin-bottom: 0.833em;
            background: #fde8e4 url(\'./images/icons/message-boxes/error.png\') no-repeat 0.833em center;
            border: 1px solid #e6bbb3;
            color: #cf4425;">'. $error .'</p>';
        }
        return $error;
    }
    
    function admin_Exists($username) {
       
        $username = sanitize($username);
        $query = mysql_query("SELECT COUNT(user_id) FROM admin WHERE userName = '$username'");
        return (mysql_result($query, 0)==1) ? true : false;              
    }
    
    function sanitize($data)
    {
        return mysql_real_escape_string($data);
        
    }
    
?>