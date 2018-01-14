<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/27/2017
 * Time: 10:19 AM
 */

    require_once("assets/dbconn.php"); //Includes necessary pages
    require_once("assets/functions.php");
    include_once("assets/header.php");

    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $sites = getAllLinks($db);

?>

<form method="get" action="#">
    <select name="Sites">
        <?php echo dropDownForm($sites) ?>
    </select>
    <input type="submit" name="action" value="Submit">
</form>


<?php

    if($action == "Submit")
    {
        $id = filter_input(INPUT_GET, 'Sites', FILTER_SANITIZE_STRING) ?? NULL;
        $links = getAllLinksByID($db, $id);
        $site = getSiteByID($db, $id);
        echo linksAsTable($site, $links);

    }



    include_once ("assets/footer.php");