<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/6/2017
 * Time: 10:49 AM
 */

    require_once("assets/dbconn.php"); //Includes necessary pages
    require_once("assets/functions.php");
    include_once("assets/header.php");
    include_once("assets/urlForm.php");


    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;

    if($action == "Add")
    {
        echo isUrlValid($db, $url);
    }

    include_once ("assets/footer.php");
?>

