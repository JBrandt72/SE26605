<?php
session_start();

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

    switch ($action) {
        default:
            include_once("catform.php");
            break;
        case 'Add':
            echo addCategory($db, $category);
            include_once("catform.php");
            break;
        case 'Edit':
            $_SESSION['cid'] = $id;
            $button = "Update";
            foreach($categories as $cat){
                if($cat['category_id'] == $id){
                    $selectedcat = $cat['category'];
                }
            }
            include_once("catform.php");
            break;
        case 'Update':
            echo updateCategory($db, $_SESSION['cid'], $category);
            break;
        case 'Delete':
            echo deleteCategory($db, $id);
            break;
    }

    include_once ("../assets/footer.php");