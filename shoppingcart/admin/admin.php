<?php
if(!isset($_SESSION))session_start();
if($_SESSION['userID'] == NULL || !isset($_SESSION['userID'])){
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
        case "CategoryMan":
            include_once("catcrud.php");
            break;
        case "ProductMan":
            include_once("prodcrud.php");
            break;
        case 'LogOut':
            header('Location: login.php');
            unset($_SESSION['userID']);
            break;
    }


    include_once("adminfooter.php");