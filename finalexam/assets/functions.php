<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 12/11/2017
 * Time: 7:40 AM
 */

function addUser($db, $email, $pwd){  //Function to add a new user to the users table
    try{
        $sql = $db->prepare("INSERT INTO users VALUES (null, :email, :password, now())"); //sql statement to add placeholders to database
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $pwd);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}