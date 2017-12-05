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
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch(PDOException $e) {
        die("There was a problem getting the record.");
    }
}


function getAllCats($db){
    $sql = "SELECT * FROM categories";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function dropDownForm($cats){
    $form = "";
    foreach($cats as $cat) {
        $form .= "<option value='" . $cat['category_id'] . "'";
        /*
        if($_GET['Sites'] == $cat['site_id']){
            $form .= "selected='selected'";
        }
        */
        $form .= ">" . $cat['category'] . "</option>";
    }
    return $form;
}


function addCategory($db, $category){  //Function to add a new actor to the database
    try{
        $sql = $db->prepare("INSERT INTO categories VALUES (null, :category)"); //sql statement to add placeholders to database
        $sql->bindParam(':category', $category);

        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}