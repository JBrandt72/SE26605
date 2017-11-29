<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/13/2017
 * Time: 8:38 AM
 */

function isUrlValid($db, $url){
    if (filter_var($url, FILTER_VALIDATE_URL) && @file_get_contents("$url")) {
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
        echo("$url is not a valid URL or not accessible");
    }
}

function addRecord($db, $url){  //Function to add a new actor to the database
    try{
        $sql = $db->prepare("INSERT INTO sites VALUES (null, :site, now())"); //sql statement to add placeholders to database
        $sql->bindParam(':site', $url);
        $sql->execute();
        $pk = $db->lastInsertId();
        echo $url . " successfully added";
        getUniqueLinks($db, $url, $pk);

    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function getUniqueLinks($db, $url, $id)
{
    $file = @file_get_contents("$url");
    $pattern = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
    $links = array();
    preg_match_all($pattern, $file, $matches, PREG_OFFSET_CAPTURE);

    foreach ($matches as $match) {
        foreach ($match as $link) {
            $links[] = $link[0];
        }
    }
    $uniqueLinks = array_unique($links);
    $uniqueLinks = array_values($uniqueLinks);
    $records = count($uniqueLinks);

    echo " with " . $records . " links" . "<br>";

    foreach ($uniqueLinks as $uniqueLink) {
        echo addLinks($db, $id, $uniqueLink);
        //$records++;
    }

    //echo " and " . $records . " links added";

}

function addLinks($db, $id, $link)
{
    try{
        $sql = $db->prepare("INSERT INTO sitelinks VALUES (:site_id, :link)"); //sql statement to add placeholders to database
        $sql->bindParam(':site_id', $id);
        $sql->bindParam(':link', $link);
        $sql->execute();
        echo $link . "<br>";
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
        $form .= "<option value='" . $site['site_id'] . "'";
        if($_GET['Sites'] == $site['site_id']){
            $form .= "selected='selected'";
        }
        $form .= ">" . $site['site'] . "</option>";
    }
    return $form;
}

function getAllLinksByID($db, $id){
    try {
        $sql = $db->prepare("SELECT * FROM sitelinks WHERE site_id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $links = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $links;
    } catch(PDOException $e) {
        die("There was a problem getting the record.");
    }
}

function getSiteByID($db, $id){
    try {
        $sql = $db->prepare("SELECT * FROM sites WHERE site_id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $links = $sql->fetch(PDO::FETCH_ASSOC);
        return $links;
    } catch(PDOException $e) {
        die("There was a problem getting the record.");
    }
}


function linksAsTable($site, $links){


    $table = "<table class='table'>" . PHP_EOL;

    $table .= "<tr><th>" . $site['site'] . " " . date("m/d/Y H:i:s", strtotime($site['date'])) . " " .  count($links) . " links" . "</th></tr>";

    foreach($links as $link){
        $table .= "<tr><td><a href='" . $link['link']  ."'  target='popup'>" . $link['link']  . "</a></td></tr>";
    }

    $table .= "</table>";

    return $table;


}

