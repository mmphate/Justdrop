<?php

    session_start();
    //error_reporting(E_ALL);
    //ini_set('display_errors',1);
    include_once 'config/database.php';
    include_once 'objects/user.php';
    include_once 'objects/utility.php';
    // Get Database connection
    $database = new Database();
    $db = $database->getConnection();

    // Pass connection to objects
    $user = new User($db);

    $utility = new Utility($db);


    $errors = array();
?>