<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/6/2017
 * Time: 7:40 AM
 */

//Session variables
session_start(); //indicates that this script will need access to session vars
$_SESSION['username']  = "Jon";
if($_SESSION['username'] == NULL || !isset($_SESSION['username'])){     //nothing can be sent to browser (not even a blank line)
    header('Location: index3.php');
}


$file = file_get_contents("http://www.cnn.com");

echo preg_match_all('/Trump/', $file, $matches, PREG_OFFSET_CAPTURE); // (pattern, subject, #matches, where it occurs)
print_r($matches);

$greps = preg_grep('/Trump/', $file); //(pattern, array-input); ($file won't work here)
print_r($greps);

/*Grabbing a primary key for a record

$db = getmy database
$sql = "INSERT INTO foo VALUES(null, 'Jon', 'Brandt');
$stmt = $db->prepare($sql);
    bind params here if we had any
$stmt->execute();
$pk = $db->lastInsertId();      gets the id of the last inserted row; (primary keys start at one, zero if it didn't happen)
*/



//password verification
$pwd = "foo";
$hash = password_hash($pwd, PASSWORD_DEFAULT); //used for storing the password in the db
$pwd = "foo";
echo "<p>" . $hash . "</p>";
$pwd = "foo";
echo "<p>" . strlen(password_hash($pwd, PASSWORD_DEFAULT)) . "</p>";

$loginpwd = "foo";
if(password_verify($loginpwd, $hash)){  //used for validation at login
    echo "valid";
} else {
    echo "invalid";
}