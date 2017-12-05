<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/3/2017
 * Time: 3:01 PM
 */

    require_once("dbconn.php");
    include_once("adminheader.php");
    require_once("functions.php");


    session_start();
    if($_SESSION['userID'] == NULL || !isset($_SESSION['userID'])){     //nothing can be sent to browser (not even a blank line)
        header('Location: login.php');
    }
    echo "User " . $_SESSION['userID'] . " logged in.";

    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;









    include_once("../assets/footer.php");