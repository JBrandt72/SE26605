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
    Sort Column:
    <select name ="colSort" value="id">
        <?php echo dropDownForm($cols) ?>
    </select>
    Ascending:<input type="radio" name="dir" value ="ASC">
    Descending:<input type="radio" name="dir" value ="DESC">
    <input type="submit" value="Submit">
    <input type="hidden" name="action" value="sort">
    <input type="submit" name="action" value="Reset">
</form>
