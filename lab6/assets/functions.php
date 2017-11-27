<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/13/2017
 * Time: 8:38 AM
 */

function isUrlValid($db, $url){
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        try{
            $sql = $db->prepare("SELECT * FROM sites WHERE site = :site"); //sql statement to add placeholders to database
            $sql->bindParam(':site', $url);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                echo("$url already exists");
            } else{
                echo addRecord($db, $url);
            }
        } catch (PDOException $e) {
            die("There was a problem accessing the database."); //Error message if it fails to add new data to the db
        }
    } else {
        echo("$url is not a valid URL");
    }
}

function addRecord($db, $url){  //Function to add a new actor to the database
    try{
        $sql = $db->prepare("INSERT INTO sites VALUES (null, :site, now())"); //sql statement to add placeholders to database
        $sql->bindParam(':site', $url);
        $sql->execute();
        $pk = $db->lastInsertId();

        echo $sql->rowCount() . " rows inserted";
        getUniqueLinks($db, $url, $pk);

    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function getUniqueLinks($db, $url, $id)
{
    $file = file_get_contents("$url");
    $pattern = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
    $links = array();
    preg_match_all($pattern, $file, $matches, PREG_OFFSET_CAPTURE);

    foreach ($matches as $match) {
        foreach ($match as $link) {
            $links[] = $link[0];
        }
    }
    $uniqueLinks = array_unique($links);

    foreach ($uniqueLinks as $uniqueLink)
    {
        print_r($uniqueLink);
        echo "<br />";
        echo addLinks($db, $id, $uniqueLink);
        echo "<br />";
    }
}

function addLinks($db, $id, $link)
{
    try{
        $sql = $db->prepare("INSERT INTO sitelinks VALUES (:site_id, :link)"); //sql statement to add placeholders to database
        $sql->bindParam(':site_id', $id);
        $sql->bindParam(':link', $link);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";

    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function getAllLinks($db){
    $sql = "SELECT * FROM sites";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function dropDownForm($sites){
    $form = "";
    foreach($sites as $site) {
        $form .= "<option value='" . $site['site_id'] . "'>";
        $form .= $site['site'] . "</option>";
    }
    return $form;
}

function getAllLinksByID($db, $id){
    try {
        $sql = $db->prepare("SELECT * FROM sitelinks WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $links = $sql->fetch(PDO::FETCH_ASSOC);
        return $links;
    } catch(PDOException $e) {
        die("There was a problem getting the record.");
    }
}

