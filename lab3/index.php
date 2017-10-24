<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:20 AM
 */
    require_once("assets/dbconn.php"); //Includes necessary pages
    require_once("assets/corps.php");
    include_once("assets/header.php");

    $db = dbConn(); //Connects to db

    echo getCorpsName($db); //Calls function to get the Corporation name for all records

    include_once ("assets/footer.php");


?>