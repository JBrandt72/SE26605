<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:20 AM
 */
    require_once("assets/dbconn.php");
    require_once("assets/corps.php"); //
    include_once("assets/header.php"); //includes the header page

    $db = dbConn();

    echo getCorpsName($db);

    include_once ("assets/footer.php"); //includes the footer page


?>