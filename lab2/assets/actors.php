<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:23 AM
 */

function getActorsAsTable($db){
    try {
        $sql = "SELECT * FROM actors";
        $sql = $db->prepare($sql);
        $sql->execute();
        $actors = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL;
            foreach ($actors as $actor) {
                $table .= "<tr><td>" . $actor['fname'] . "</td><td>" . $actor['lname'] . "</td><td>" . $actor['dob'] . "</td><td>" . $actor['height'] . "</td>";
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else {
            $table = "There are no actors." . PHP_EOL;
        }
        return $table;
    } catch (PDOException $e){
        die("There was a problem getting the actors.");
    }

}

function addActor($db, $firstname, $lastname, $dob, $height){
    try{
        $sql = $db->prepare("INSERT INTO dogs VALUES (null, :firstname, :lastname, :dob, :height)");
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the actor.");
    }
}