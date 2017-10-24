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
    include_once ("corpsform.php");

    $db = dbConn();
    $id = filter_input(INPUT_GET, 'id');

    $corpname = filter_input(INPUT_POST, 'corpname', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";


    echo getCorp($db, $id);

    echo updateRecord($db, $id, $corpname, $email, $zip, $owner, $phone);

    include_once ("footer.php");
?>