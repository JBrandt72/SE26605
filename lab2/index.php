<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:20 AM
 */
    require_once("assets/dbconn.php");
    require_once ("assets/actors.php");
    include_once("assets/header.php");
    $db = dbConn();
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING) ?? "";
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING) ?? "";
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
    $height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";
    switch($action){
        case "Add":
            addActor($db, $firstname, $lastname, $dob, $height);
            $button = "Add";
            break;
    }
    echo getActorsAsTable($db);
    include_once ("assets/actorform.php");
    include_once ("assets/footer.php");


?>