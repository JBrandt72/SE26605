<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/23/2017
 * Time: 11:03 AM
 */

    require_once("dbconn.php");
    require_once("corps.php"); //
    include_once("header.php");
?>
    <a href='../index.php'>Return to View Page</a>

<?php
    $button = "Add";
    include_once ("corpsform.php");

    $db = dbConn();
    $id = filter_input(INPUT_GET, 'id');
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
    $corpname = filter_input(INPUT_POST, 'corpname', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

    if($action == "Add") {
        echo addRecord($db, $id, $corpname, $email, $zip, $owner, $phone);
        echo getCorp($db, $id);
    }

    include_once ("footer.php");
?>
