<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:23 AM
 */

function dbConn() //function to connect to database
{
    $dsn = "mysql:host=localhost;dbname=phpclassfall2017"; //saves info to separate variables for security
    $username = "PHPClassFall2017";
    $password = "se266";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("There was a problem connecting to the db."); //error message if it fails to connect
    }

}