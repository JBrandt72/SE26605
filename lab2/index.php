<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:20 AM
 */
    require_once("assets/dbconn.php");
    require_once ("assets/corps.php"); //
    include_once("assets/header.php"); //includes the header page
    $db = dbConn();
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? ""; //saves value of the submit button named action to a variable
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING) ?? ""; //saves all the text from the textboxes to corresponding variables
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING) ?? "";
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
    $height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";
    switch($action){
        case "Add":
            addActor($db, $firstname, $lastname, $dob, $height);  //case compares value of action; passes the variables to the addActor function
            $button = "Add";    //sets the value of the button to "Add"
            break;
    }
    echo getActorsAsTable($db);
    include_once ("assets/corpsform.php"); //includes the form page
    include_once ("assets/footer.php"); //includes the footer page


?>