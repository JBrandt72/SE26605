<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/23/2017
 * Time: 11:03 AM
 */

    require_once("dbconn.php"); //Includes necessary pages
    require_once("corps.php");
    include_once("header.php");
?>

    <a href='../index.php'>Return to View Page</a><br /> <!--Link to return to view page-->

<?php
    $db = dbConn();
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //Gets id from url


    echo getCorp($db, $id);
    echo "<a href='updatepage.php?id=" .  $id . "'>Update </a><a href='deletepage.php?id=" .  $id . "'> Delete</a>"; //Links to update/delete pages

?>

<?php
    include_once ("footer.php");
?>