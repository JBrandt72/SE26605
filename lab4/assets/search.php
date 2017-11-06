<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 11/5/2017
 * Time: 12:47 PM
 */

    require_once("dbconn.php");
    $db = dbConn();
    $cols = getColumnNames($db, 'corps');

?>

<form method="get">
    Search Column:
    <select name ="colSearch">
        <?php echo dropDownForm($cols) ?>
    </select>
    Term:<input type="text" name="term" id ="term">
    <input type="submit" value="Submit">
    <input type="hidden" name="action" value="search">
    <input type="submit" name="action" value="Reset">
</form>


