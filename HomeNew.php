<?php
include 'core/init.php';
    if(logged_In()===false){
       echo '<h1> Sorry,You need to Login First. </h1>';
       header('Location: login.php');
       exit();
    }
    else {
        echo '<a href="logout.php"><h1> LOGOUT </h1></a1>'; 
    }

?>