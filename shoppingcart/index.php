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
            echo viewStoreProducts($db, $catid);
            break;
        case 'Add':
            $prod = getOneProduct($db, $prodid);
            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
                $_SESSION['cart'][] = $prod;
            } else{
                $_SESSION['cart'][]= $prod;
            }
            print_r($_SESSION['cart']);
            include_once("assets/header.php");
            include_once("assets/inventoryform.php");
            echo viewStoreProducts($db, $catid);
            break;
        case 'Cart':
            include_once("assets/header.php");
            foreach($_SESSION['cart'] as $items){
                    print_r($items);
            }
            echo "<form method='get' action='index.php'><input type='submit' name='action' value='Empty'></form>";
            break;
        case 'Empty':
            unset($_SESSION['cart']);
    }



    include_once("assets/footer.php");