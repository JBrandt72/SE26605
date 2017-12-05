<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/4/2017
 * Time: 6:45 PM
 */

    require_once("dbconn.php");
    include_once("adminheader.php");
    require_once("functions.php");

    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $categories = getAllCats($db);
    $product = filter_input(INPUT_POST, 'product', FILTER_SANITIZE_STRING) ?? NULL;
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING) ?? NULL;
    $image = filter_input(INPUT_POST, 'image', filter) ?? NULL;
    $button = "Add";


    switch ($action) {
        default:
            include_once("prodform.php");
            break;
        case 'Add':
            echo addProduct($db, $product); //calls function to add new record
            break;
        case 'Edit':
            $button = "Update";
            break;
        case 'Update':
            echo updateProduct($db, $id, $category);
            $button = "Add";
            break;
        case 'Delete':
            echo deleteCategory($db, $id);
            break;
    }


    include_once ("../assets/footer.php");