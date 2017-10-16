<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/16/2017
 * Time: 8:55 AM
 */

function getDogsAsTable($db){
    try {
        $sql = "SELECT * FROM dogs";
        $sql = $db->prepare($sql);
        $sql->execute();
        $dogs = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL;
            foreach ($dogs as $dog) {
                $table .= "<tr><td>" . $dog['name'] . "</td><td>" . $dog['gender'] . "</td><td>" . $dog['fixed'] . "</td>";
                $table .= "<td><form method='post' action='#'><input type = 'hidden' name='id' value ='" . $dog['id'] . "' /><input type='submit' name='action' value='Edit' /></form></td>";
                $table .= "<td><form method='post' action='#'><input type = 'hidden' name='id' value ='" . $dog['id'] . "' /><input type='submit' name='action' value='Delete' /></form></td>";
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else {
            $table = "Life is sad. There are no dogs." . PHP_EOL;
        }
            return $table;
    } catch (PDOException $e){
        die("There was a problem getting the dags.");
    }

}

function addDog($db, $name, $gender, $fixed){
    try{
        $sql = $db->prepare("INSERT INTO dogs VALUES (null, :name, :gender, :fixed)");
        $sql->bindParam(':name', $name);
        $sql->bindParam(':gender', $gender);
        $sql->bindParam(':fixed', $fixed);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the dog.");
    }
}