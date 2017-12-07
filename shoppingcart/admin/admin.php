<?php
if(!isset($_SESSION))session_start();                               //Checks if session is in progress before starting new session
if($_SESSION['userID'] == NULL || !isset($_SESSION['userID'])){         //Checks if valid user session is active and redirects to the login page if not
    header('Location: login.php');
}

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    switch ($action) {
        default:
            include_once("adminheader.php");
            require_once("dbconn.php");
            require_once("functions.php");
            break;
        case "CategoryMan":                     //Includes page for category management
            include_once("catcrud.php");
            break;
        case "ProductMan":                      //Includes page for product management
            include_once("prodcrud.php");
            break;
        case 'LogOut':                          //Redirects to the login page
            header('Location: login.php');
            unset($_SESSION['userID']);
            break;
    }


    include_once("adminfooter.php");