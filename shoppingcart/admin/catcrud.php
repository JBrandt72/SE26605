<?php
if(!isset($_SESSION))session_start();                               //Checks if session is in progress before starting new session
if($_SESSION['userID'] == NULL || !isset($_SESSION['userID'])){         //Checks if valid user session is active and redirects to the login page if not
    header('Location: login.php');
}

    require_once("dbconn.php");
    include_once("adminheader.php");
    require_once("functions.php");


    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $categories = getAllCats($db);
    $catid = filter_input(INPUT_GET, 'Categories', FILTER_SANITIZE_STRING) ?? NULL;
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING) ?? NULL;
    $button = "Add";
    $selectedcat = "";

    switch ($action) {
        default:
            include_once("catform.php");
            break;
        case 'View':
            echo include_once("catform.php");
            echo viewProductsAsTable($db,$catid);       //Displays all products of a given category
            break;
        case 'Add':
            echo addCategory($db, $category);           //Calls function to add new category to db
            include_once("catform.php");
            break;
        case 'Edit':
            $_SESSION['cid'] = $catid;
            $button = "Update";
            foreach($categories as $cat){                   //Displays category selected for editing
                if($cat['category_id'] == $catid){
                    $selectedcat = $cat['category'];
                }
            }
            include_once("catform.php");
            break;
        case 'Update':
            echo updateCategory($db, $_SESSION['cid'], $category);      //Updates a category in the db
            break;
        case 'Delete':
            if(checkForProducts($db, $catid)){                      //Calls function to check if a category has products before being deleted
                echo "This category still has products.";
            } else{
                echo deleteCategory($db, $catid);
            }
            break;
    }

