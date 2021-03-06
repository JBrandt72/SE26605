<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:20 AM
 */
    require_once("assets/dbconn.php"); //Includes necessary pages
    require_once("assets/corps.php");
    include_once("assets/header.php");
    include_once("assets/sort.php");
    include_once("assets/search.php");

    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $colSort = filter_input(INPUT_GET, 'colSort', FILTER_SANITIZE_STRING) ?? NULL;
    $dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? NULL;
    $colSearch = filter_input(INPUT_GET, 'colSearch', FILTER_SANITIZE_STRING) ?? NULL;
    $term = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING) ?? NULL;


    switch ($action) {
        default:
            include_once ('assets/header.php');
            echo getCorpsName($db, $colSort, $dir); //Calls function to get the Corporation name for all records
            break;
        case 'sort':
            include_once ('assets/header.php');
            echo getCorpsName($db, $colSort, $dir); //Calls function to get the sorted names for all records
            break;
        case 'search':
            include_once ('assets/header.php');
            //print_r($colSearch);
            echo searchCorpCols($db, $colSearch, $term); //Calls function to search by category
            break;
        case 'Reset':
            echo getCorpsName($db, $colSort, $dir); //Calls function to get the names in the default sort
            break;

    }


    include_once ("assets/footer.php");
?>