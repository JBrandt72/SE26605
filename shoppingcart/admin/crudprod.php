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
    $catid = filter_input(INPUT_POST, 'Categories', FILTER_SANITIZE_STRING) ?? NULL;
    $product = filter_input(INPUT_POST, 'product', FILTER_SANITIZE_STRING) ?? NULL;
    $prodid = filter_input(INPUT_GET, 'prodID', FILTER_VALIDATE_INT) ??   //Gets id from url
        filter_input(INPUT_POST, 'pid', FILTER_VALIDATE_INT) ?? NULL;
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING) ?? NULL;
    $button = "Add";

    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(substr($file_name, strpos($file_name, '.')+1));
    }

    switch ($action) {
        default:
            include_once("prodform.php");
            break;
        case 'View':
            echo include_once("prodform.php");
            echo viewProductsAsTable($db,$catid);
            break;
        case 'Add':
            if(checkImage($ext))
            {
                move_uploaded_file($file_tmp,"images/".$file_name);
                echo addProduct($db, $catid, $product, $price, $file_name); //calls function to add new record
            }
            break;
        case 'Edit':
            $button = "Update";
            $prod = getOneProduct($db, $prodid);
            include_once("produpdateform.php");
            break;
        case 'Update':
            if (!isset($_POST['keepimg']) && checkImage($ext)) {
                $image = $file_name;
                move_uploaded_file($file_tmp,"images/".$file_name);
            } else {
                $image = filter_input(INPUT_POST, 'imageOG', FILTER_SANITIZE_STRING) ?? NULL;
            }
            echo updateProduct($db, $prodid, $catid, $product, $price, $image);
            break;
        case 'Delete':
            echo deleteProduct($db, $prodid);
            break;
    }


    include_once ("../assets/footer.php");