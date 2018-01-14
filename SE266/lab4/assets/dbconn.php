<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:23 AM
 */

function dbConn() //function to connect to database
{
    $dsn = "mysql:host=localhost;dbname=phpclassfall2017"; //saves info to separate variables for security
    $username = "PHPClassFall2017";
    $password = "se266";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("There was a problem connecting to the db."); //error message if it fails to connect
    }

}

function getColumnNames($db, $tbl){

    $sql = "select column_name from information_schema.columns where lower(table_name)=lower('". $tbl . "')";
    $stmt = $db->prepare($sql);

    try {
        if($stmt->execute()):
            $raw_column_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($raw_column_data as $outer_key => $array):
                foreach($array as $inner_key => $value):
                    if (!(int)$inner_key):
                        $column_names[] = $value;
                    endif;
                endforeach;
            endforeach;
        endif;
    } catch (Exception $e){
        die("There was a problem retrieving the column names");
    }
    //print_r($column_names);
    //exit;
    return $column_names;
}       //function to get column names from db

function dropDownForm($cols){                 //function to create drop down options based on columns retrieved from db
    $option = "";
    foreach($cols as $col){
        $option .= "<option value='" . $col . "'>";
        $option .= $col . "</option>";
    }
    return $option;
}