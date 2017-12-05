<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/4/2017
 * Time: 6:44 PM
 */

    require_once("dbconn.php");
    include_once("adminheader.php");
    require_once("functions.php");


    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $categories = getAllCats($db);
    $id = filter_input(INPUT_GET, 'Categories', FILTER_SANITIZE_STRING) ?? NULL;
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING) ?? NULL;
    $button = "Add";
    $selectedcat = "";

    echo $action;
    switch ($action) {
        default:
            $button = "Add";
            include_once ("catdropdownform.php");
            include_once ("catform.php");
            break;
        case 'Add':
            echo addCategory($db, $category); //calls function to add new record
            include_once ("catdropdownform.php");
            include_once ("catform.php");
            break;
        case 'Edit':
            $button = "Update";
            foreach($categories as $cat) {
                if($cat['category_id'] == $id){
                    $selectedcat = $cat['category'];
                }
            }
            include_once ("catdropdownform.php");
            include_once ("catform.php");
            break;
        case 'Update':
            echo "ID: " . $id . "CAT:" . $category;
            echo updateCategory($db, $id, $category);
            $button = "Add";
            include_once ("catdropdownform.php");
            include_once ("catform.php");
            break;
        case 'Delete':

            break;
        case 'View':

            break;
    }

    include_once ("../assets/footer.php");