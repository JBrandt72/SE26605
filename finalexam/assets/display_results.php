<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 12/11/2017
 * Time: 8:00 AM
 */

    require_once("dbconn.php");
    require_once("functions.php");

    //include_once("assets/webform.php");


    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? NULL;
    $heard = filter_input(INPUT_POST, 'heard_from', FILTER_SANITIZE_STRING) ?? NULL;
    $contact = filter_input(INPUT_POST, 'contact_via', FILTER_SANITIZE_STRING) ?? NULL;
    $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING) ?? NULL;


    if($action == "Submit"){

        echo $email . $phone . $heard . $contact . $comments;
    }



