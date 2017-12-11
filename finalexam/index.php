<?php
/**
Jonathan Brandt
 */

    require_once("assets/dbconn.php");
    require_once("assets/functions.php");
    include_once("assets/header.php");


    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? NULL;
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? NULL;
    $heard = filter_input(INPUT_POST, 'heard_from', FILTER_SANITIZE_STRING) ?? NULL;
    $contact = filter_input(INPUT_POST, 'contact_via', FILTER_SANITIZE_STRING) ?? NULL;
    $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING) ?? NULL;


    switch ($action) {
        default:
            include_once("assets/webform.php");         //Default case displays webform on pageload
            break;
        case 'Manage':                  //Displays webform at any given time to add new records
            include_once("assets/webform.php");
            break;
        case 'Add':
            $requiredcheck = checkRequiredFields($email, $phone, $heard, $contact);     //Calls functoin to check if required fields are filled in
            if($requiredcheck == false){
                include_once("assets/errorform.php");       //Displays form if not valid with last entered user data
            } else{
                $phonecheck = checkPhone($phone);       //Calls function to check if phone number was entered in desired format
                if($phonecheck == false) {
                    include_once("assets/errorform.php");   //Displays form if not valid with last entered user data
                } else {
                    echo addAccount($db, $email, $phone, $heard, $contact, $comments);  //Calls function to add new record to account table
                }
            }
            break;
        case 'View':                //Displays the account data as a table
            echo viewAccountsAsTable($db);
            break;
    }


    include_once("assets/footer.php");
