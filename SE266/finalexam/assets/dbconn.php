<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/29/2017
 * Time: 11:01 AM
 */

function dbConn() //function to connect to database
{
    $dsn = "mysql:host=localhost;dbname=phpclassfall2017"; //saves info to separate variables for security
    $username = "PHPClassFall2017";
    $password = "SE266";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("There was a problem connecting to the db."); //error message if it fails to connect
    }

}