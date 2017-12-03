<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/3/2017
 * Time: 2:17 PM
 */

function addUser($db, $email, $pwd){  //Function to add a new user to the database
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

function getUserLogin($db, $email)
{
    try {
        $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch(PDOException $e) {
        die("There was a problem getting the record.");
    }
}