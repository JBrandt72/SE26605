<?php
if(!isset($_SESSION))session_start();                               //Checks if session is in progress before starting new session
if($_SESSION['userID'] == NULL || !isset($_SESSION['userID'])){     //Checks if valid user session is active and redirects to the login page if not
    header('Location: login.php');
}

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

    if(isset($_FILES['image'])){                    //Checks if image variable exists
        $file_name = $_FILES['image']['name'];          //Gets filename and temp name for moving the file
        $file_tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(substr($file_name, strpos($file_name, '.')+1));  //Gets the file extension
    }

    switch ($action) {
        default:
            include_once("prodform.php");
            break;
        case 'View':
            include_once("prodform.php");
            echo viewProductsAsTable($db,$catid);
            break;
        case 'Add':
            if(checkImage($ext))                                        //Calls function to check for valid file extension (jpg or png only in this case)
            {
                move_uploaded_file($file_tmp,"images/".$file_name);     //Moves file to images folder
                echo addProduct($db, $catid, $product, $price, $file_name);     //Calls function to add new record
            }
            break;
        case 'Edit':
            $button = "Update";
            $prod = getOneProduct($db, $prodid);
            include_once("produpdateform.php");
            break;
        case 'Update':
            if (!isset($_POST['keepimg']) && checkImage($ext)) {            //Checks whether or not checkbox to keep the image was selected and if new file has a valid extension
                $image = $file_name;
                move_uploaded_file($file_tmp,"images/".$file_name);     //Gets new file name and uploads it to the images folder
            } else {
                $image = filter_input(INPUT_POST, 'imageOG', FILTER_SANITIZE_STRING) ?? NULL;   //Gets original image filename
            }
            echo updateProduct($db, $prodid, $catid, $product, $price, $image);
            break;
        case 'Delete':
            echo deleteProduct($db, $prodid);       //Deletes a given product
            break;
    }


