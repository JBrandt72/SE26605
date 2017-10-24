<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/23/2017
 * Time: 11:03 AM
 */

    require_once("dbconn.php");
    require_once("corps.php"); //
    include_once("header.php");
?>

    <a href='../index.php'>Return to View Page</a><br />

<?php
    $db = dbConn();
    $id = filter_input(INPUT_GET, 'id');


    echo getCorp($db, $id);
    echo "<a href='updatepage.php?id=" .  $id . "'>Update </a><a href='deletepage.php?id=" .  $id . "'> Delete</a>";

?>

<?php
    include_once ("footer.php");
?>