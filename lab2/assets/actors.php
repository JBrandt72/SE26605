<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:23 AM
 */

function getActorsAsTable($db){     //function to get actors from database and display the data in a table
    try {
        $sql = "SELECT * FROM actors";
        $sql = $db->prepare($sql);
        $sql->execute();
        $actors = $sql->fetchAll(PDO::FETCH_ASSOC); //gets all data from the table and saves it to actors at an asaociative array
        if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL; //
            foreach ($actors as $actor) {
                $table .= "<tr><td>" . $actor['firstname'] . "</td><td>" . $actor['lastname'] . "</td><td>" . $actor['dob'] . "</td><td>" . $actor['height'] . "</td>"; //adds cells holding actor data to the string building the table
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else {
            $table = "There are no actors." . PHP_EOL; //message saved to the variable if the db table is empty
        }
        return $table; //returns the table variable holding a string for the entire table
    } catch (PDOException $e){
        die("There was a problem getting the actors."); //output if it fails to access database
    }

}

function addActor($db, $firstname, $lastname, $dob, $height){       //function to add a new actor to the database
    try{
        $sql = $db->prepare("INSERT INTO actors VALUES (null, :firstname, :lastname, :dob, :height)"); //sql statement to add placeholders to database
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the actor."); //error message if it fails to add new data to the db
    }
}