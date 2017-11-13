<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/13/2017
 * Time: 8:38 AM
 */


function addRecord($db, $url){  //Function to add a new actor to the database
    try{
        $sql = $db->prepare("INSERT INTO sites VALUES (null, :site, now())"); //sql statement to add placeholders to database
        $sql->bindParam(':site', $url);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}