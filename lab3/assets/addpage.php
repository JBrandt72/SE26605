<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/23/2017
 * Time: 11:03 AM
 */
    require_once("dbconn.php"); //Includes necessary pages
    require_once("corps.php");
    include_once("header.php");
?>
    <a href='../index.php'>Return to View Page</a><br /> <!--Link to return to view page-->
<?php
    $button = "Add";
    include_once ("corpsform.php");

    $db = dbConn();
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //Gets id from url
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";    //Saves user input to variables
    $corpname = filter_input(INPUT_POST, 'corpname', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

    if($action == "Add") {
        echo addRecord($db, $corpname, $email, $zip, $owner, $phone); //If statement to call function to add new record (wanted to try both methods)
    }

    include_once ("footer.php");
?>
