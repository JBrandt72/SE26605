<?php
if(!isset($_SESSION))session_start();

    require_once("admin/dbconn.php");
    require_once("admin/functions.php");

    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $categories = getAllCats($db);
    $catid = filter_input(INPUT_GET, 'Categories', FILTER_SANITIZE_STRING) ?? NULL;
    $prodid = filter_input(INPUT_GET, 'prodID', FILTER_VALIDATE_INT) ?? NULL;


    switch ($action) {
        default:
            include_once("assets/header.php");
            include_once("assets/inventoryform.php");
            break;
        case 'View':
            include_once("assets/header.php");
            include_once("assets/inventoryform.php");
            echo viewStoreProducts($db, $catid); //Calls function to display all products in a category
            break;
        case 'Add':
            $prod = getOneProduct($db, $prodid); //Gets details for one product from the db
            if(!isset($_SESSION['cart'])) {     //Checks if session variable exits and adds the product details to the array
                $_SESSION['cart'] = [];
                $_SESSION['cart'][] = $prod;
            } else{
                $_SESSION['cart'][]= $prod;
            }
            include_once("assets/header.php");
            include_once("assets/inventoryform.php");
            echo viewStoreProducts($db, $catid);
            break;
        case 'Cart':
            include_once("assets/header.php");
            echo viewCartAsTable();     //Calls function to display cart contents for checkout
            break;
        case 'Remove':
            $key = $_GET['key'];    //Gets key for particular product and removes it from cart
            if(isset($_SESSION['cart'])) {
               unset($_SESSION['cart'][$key]);
            }
            include_once("assets/header.php");
            echo viewCartAsTable();
            break;
        case 'Empty':
            unset($_SESSION['cart']);       // Empties cart of all products
            include_once("assets/header.php");
            include_once("assets/inventoryform.php");
    }


    include_once("assets/footer.php");