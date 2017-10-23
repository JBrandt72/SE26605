<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:20 AM
 */
    require_once("assets/dbconn.php");
    require_once("assets/corps.php"); //
    include_once("assets/header.php"); //includes the header page
    $db = dbConn();
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? ""; //saves value of the submit button named action to a variable
    $corpname = filter_input(INPUT_POST, 'corpname', FILTER_SANITIZE_STRING) ?? ""; //saves all the text from the textboxes to corresponding variables
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";
    switch($action){
        case "Add":
            addCorp($db, $corpname, $date, $email, $zip, $owner, $phone);  //case compares value of action; passes the variables to the addActor function
            $button = "Add";    //sets the value of the button to "Add"
            break;
        case "Edit":
            $corp = getCorp($db, $id);
            $button = "Update";
            echo $button;
            break;
        case "Update":
            break;
        case "Delete":
            break;
    }
    //echo getCorpsAsTable($db);
    echo $corps;
    include_once("assets/corpsform.php"); //includes the form page
    include_once ("assets/footer.php"); //includes the footer page


?>