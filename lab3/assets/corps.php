<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:23 AM
 */

function getCorpsName($db){
    try {
        $sql = "SELECT * FROM corps";
        $sql = $db->prepare($sql);
        $sql->execute();
        $corps = $sql->fetchAll(PDO::FETCH_ASSOC); //Gets all data from the table and saves it to actors at an associative array
        if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL; //
            $table .= "<tr><td><a href='assets/addpage.php'>Add a new record</a></td></tr>" . PHP_EOL;
            foreach ($corps as $corp) {
                $table .= "<tr><td>" . $corp['corp'] . "</td>"; //adds cells holding actor data to the string building the table
                $table .= "<td><a href='assets/readpage.php?id=" .  $corp['id'] . "'>Read</a></td>";
                $table .= "<td><a href='assets/updatepage.php?id=" .  $corp['id'] . "'>Update</a></td>";
                $table .= "<td><a href='assets/deletepage.php?id=" .  $corp['id'] . "'>Delete</a></td>";
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else {
            $table = "There are no records." . PHP_EOL; //Message saved to the variable if the db table is empty
        }
        return $table; //Returns the table variable holding a string for the entire table
    } catch (PDOException $e){
        die("There was a problem getting the records."); //Output if it fails to access database
    }
}

function getCorp($db, $id){
    $sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $corp = $sql->fetch(PDO::FETCH_ASSOC);
    $table = "<table>" . PHP_EOL;
    $table .= "<tr><th>Coporation</th><th>Date</th><th>Email</th><th>Zipcode</th><th>Owner</th><th>Phone</th></tr>";
    $table .= "<tr><td>" . $corp['corp'] . "</td><td>" . $corp['incorp_dt'] . "</td><td>" . $corp['email'] . "</td><td>" . $corp['zipcode'] . "</td><td>" . $corp['owner'] . "</td><td>" . $corp['phone'] . "</td>"; //adds cells holding actor data to the string building the table
    $table .= "</tr></table>";
    return $table;
}

function getCorpStats($db, $id){
    try {
        $sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $corp = $sql->fetch(PDO::FETCH_ASSOC);
        return $corp;
    } catch(PDOException $e) {
        die("There was a problem getting the record.");
    }
}

function addRecord($db, $corpname, $email, $zip, $owner, $phone){  //Function to add a new actor to the database
    try{
        $sql = $db->prepare("INSERT INTO corps VALUES (null, :corp, now(), :email, :zipcode, :owner, :phone)"); //sql statement to add placeholders to database
        $sql->bindParam(':corp', $corpname);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zip);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function updateRecord($db, $id, $corpname, $email, $zip, $owner, $phone){   //Function to update a record in the database
    try {
        $sql = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':corp', $corpname);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zip);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return "Update complete.";
    } catch (PDOException $e){
        die("There was a problem updating the record."); //Error message if it fails to add new data to the db
    }
}

function deleteRecord($db, $id){  //Function to delete a record from the database
    try {
        $sql = $db->prepare("DELETE FROM corps WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        return "Record " . $id ." deleted.";
    } catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}