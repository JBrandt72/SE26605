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
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? NULL;
    $col = filter_input(INPUT_GET, 'col', FILTER_SANITIZE_STRING) ?? NULL;


    echo getCorpsName($db, $col, $dir); //Calls function to get the Corporation name for all records

switch ($action) {
    case 'sort':
        include_once ('assets/header.php');
        $sortable = true;
        $employees = getEmployeesAsSortedTable($db, $col, $dir);
        $cols = getColumnNames($db, 'employees');
        echo getEmployeesAsTable($db, $employees, $cols, $sortable);
        break;
    default:
        include_once ('assets/header.php');
        $sortable = true;
        $employees = getEmployees($db);
        $cols = getColumnNames($db, 'employees');
        echo getEmployeesAsTable($db, $employees, $cols, $sortable);
        break;
}



    include_once ("assets/footer.php");
?>