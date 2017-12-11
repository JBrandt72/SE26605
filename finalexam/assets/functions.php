<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 12/11/2017
 * Time: 7:40 AM
 */

function checkRequiredFields($email, $phone, $heard, $contact){  //Function to add a new user to the users table

    if(strlen($email) == 0){
        $check = false;
    } else if(strlen($phone) == 0){
        $check = false;
    } else if(strlen($heard) == 0){
        $check = false;
    } else {
        $check = true;
    }

    return $check;
}

function addAccount($db, $email, $phone, $heard, $contact, $comments){  //Function to add a new user to the users table
    try{
        $sql = $db->prepare("INSERT INTO accounts VALUES (null, :email, :phone, :heard, :contact, :comments)"); //sql statement to add placeholders to database
        $sql->bindParam(':email', $email);
        $sql->bindParam(':phone', $phone);
        $sql->bindParam(':heard', $heard);
        $sql->bindParam(':contact', $contact);
        $sql->bindParam(':comments', $comments);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function viewAccountsAsTable($db){
    try {
        $sql = $db->prepare("SELECT * FROM accounts");
        $sql->execute();
        $accounts = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>ID</th><th>Email</th><th>Phone</th><th>Heard From</th><th>Contact Preference</th><th>Comments</th></tr>";
        foreach ($accounts as $account) {
            $table .= "<tr><td>" . $account['id'] . "</td><td>" . $account['email'] . "</td><td>" . $account['phone'] . "</td>";
            $table .= "<td>" . $account['heard'] . "</td><td>" . $account['contact'] . "</td><td>" . $account['comments'] . "</td></tr>";
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function dropDownForm($contact){   //Function to populate the dropdown form with selected category
    $form = "";
    if ($contact == 'email'){
        $form .= "<option value='email' selected='selected'>Email</option>";
    }else {
        $form .= "<option value='email'>Email</option>";
    }
    if ($contact == 'text'){
        $form .= "<option value='text' selected='selected'>Text Message</option>";
    }else {
        $form .= "<option value='text'>Text Message</option>";
    }
    if ($contact == 'phone'){
        $form .= "<option value='phone' selected='selected'>Phone</option>";
    }else {
        $form .= "<option value='phone'>Phone</option>";
    }

    return $form;
}

function radioForm($heard) {
    $form = "<p>How did you hear about us?</p>";

    if ($heard == 'Search Engine'){
        $form .= "<input type='radio' name='heard_from' value='Search Engine' selected='selected'/>Search engine<br />";
    }else {
        $form .= "<input type='radio' name='heard_from' value='Search Engine' />Search engine<br />";
    }
    if ($heard == 'Friend'){
        $form .= "<input type='radio' name='heard_from' value='Friend' selected='selected'/>Word of mouth<br />";
    }else {
        $form .= "<input type='radio' name='heard_from' value='Friend'/>Word of mouth<br />";
    }
    if ($heard == 'Other'){
        $form .= "<input type='radio' name='heard_from' value='Other' selected='selected'>Other<br />";
    }else {
        $form .= "<input type='radio' name='heard_from' value='Other'>Other<br />";
    }

    return $form;

}