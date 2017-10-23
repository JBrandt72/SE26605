<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:23 AM
 */

function getCorpsAsTable($db){     //function to get actors from database and display the data in a table
    try {
        $sql = "SELECT * FROM corps";
        $sql = $db->prepare($sql);
        $sql->execute();
        $corps = $sql->fetchAll(PDO::FETCH_ASSOC); //gets all data from the table and saves it to actors at an asaociative array
        if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL; //
            foreach ($corps as $corp) {
                $table .= "<tr><td>" . $corp['corpname'] . "</td><td>" . $corp['date'] . "</td><td>" . $corp['email'] . "</td><td>" . $corp['zip'] . "</td><td>" . $corp['owner'] . "</td><td>" . $corp['phone'] . "</td>"; //adds cells holding actor data to the string building the table
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else {
            $table = "There are no corps." . PHP_EOL; //message saved to the variable if the db table is empty
        }
        return $table; //returns the table variable holding a string for the entire table
    } catch (PDOException $e){
        die("There was a problem getting the actors."); //output if it fails to access database
    }

}

function addCorp($db, $corpname, $date, $email, $zip, $owner, $phone){       //function to add a new actor to the database
    try{
        $sql = $db->prepare("INSERT INTO corps VALUES (null, :corp, :incorp_dt, :email, :zipcode, :owner, :phone)"); //sql statement to add placeholders to database
        $sql->bindParam(':corp', $corpname);
        $sql->bindParam(':incorp_dt', $date);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zip);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the corporation."); //error message if it fails to add new data to the db
    }
}

function getCorp($db, $id){
    $sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    return $row;

}