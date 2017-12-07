<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/3/2017
 * Time: 2:17 PM
 */

function addUser($db, $email, $pwd){  //Function to add a new user to the users table
    try{
        $sql = $db->prepare("INSERT INTO users VALUES (null, :email, :password, now())"); //sql statement to add placeholders to database
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $pwd);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function getUserLogin($db, $email)  //Function to get all data from the users table
{
    try {
        $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch(PDOException $e) {
        die("There was a problem getting the record.");
    }
}


function getAllCats($db){   //Function to get all data from the categories table
    $sql = "SELECT * FROM categories";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function dropDownForm($cats){   //Function to populate the dropdown form with data from the categories table
    $form = "";
    foreach($cats as $cat) {
        $form .= "<option value='" . $cat['category_id'] . "'";

        if($_GET['Categories'] == $cat['category_id'] || $_POST['Categories'] == $cat['category_id'] ){
            $form .= "selected='selected'";
        }

        $form .= ">" . $cat['category'] . "</option>";
    }
    return $form;
}


function addCategory($db, $category){  //Function to add a new record to the categories table
    try{
        $sql = $db->prepare("INSERT INTO categories VALUES (null, :category)"); //sql statement to add placeholders to database
        $sql->bindParam(':category', $category);

        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function updateCategory($db, $category_id, $category){   //Function to update a record in the categories table
    try {
        $sql = $db->prepare("UPDATE categories SET category = :category WHERE category_id = :category_id");
        $sql->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $sql->bindParam(':category', $category);
        $sql->execute();
        //return "Update complete.";
        return $sql->rowCount() . " row updated";
    } catch (PDOException $e){
        die("There was a problem updating the record."); //Error message if it fails to add new data to the db
    }
}

function deleteCategory($db, $id){  //Function to delete a record from the database
    try {
        $sql = $db->prepare("DELETE FROM categories WHERE category_id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        return "Record " . $id ." deleted.";
    } catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function checkImage($file_ext){ //Function to check if image has proper file extension
    $extensions= array("jpeg","jpg","png");
    $check = false;
    if(in_array($file_ext,$extensions)=== false){
        echo "Please choose a valid file type (jpg, png)";
    } else {
        $check = true;
        echo "Valid";
    }
    return $check;
}

function addProduct($db, $category_id, $product, $price, $image){  //Function to add a new record to the products table
    try{
        $sql = $db->prepare("INSERT INTO products VALUES (null, :category_id, :product, :price, :image)"); //sql statement to add placeholders to database
        $sql->bindParam(':category_id', $category_id);
        $sql->bindParam(':product', $product);
        $sql->bindParam(':price', $price);
        $sql->bindParam(':image', $image);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function updateProduct($db, $product_id, $category_id, $product, $price, $image){   //Function to update a record in the products table
    try {
        $sql = $db->prepare("UPDATE products SET category_id = :category_id, product = :product, price = :price, image = :image WHERE product_id = :product_id");
        $sql->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $sql->bindParam(':category_id', $category_id);
        $sql->bindParam(':product', $product);
        $sql->bindParam(':price', $price);
        $sql->bindParam(':image', $image);
        $sql->execute();
        //return "Update complete.";
        return $sql->rowCount() . " row updated";
    } catch (PDOException $e){
        die("There was a problem updating the record."); //Error message if it fails to add new data to the db
    }
}

function deleteProduct($db, $product_id){  //Function to delete a record from the database
    try {
        $sql = $db->prepare("DELETE FROM products WHERE product_id = :product_id");
        $sql->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $sql->execute();
        return "Record " . $product_id ." deleted.";
    } catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function checkForProducts($db, $id){
    try {
        $sql = $db->prepare("SELECT * FROM products WHERE category_id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $check = true;
        } else{
            $check = false;
        }
        return $check;
    } catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function getOneProduct($db, $id){
    try {
        $sql = $db->prepare("SELECT * FROM products WHERE product_id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $prod = $sql->fetch(PDO::FETCH_ASSOC);
        return $prod;
    } catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function viewProductsAsTable($db, $category_id){
    try {
        $sql = $db->prepare("SELECT * FROM products WHERE category_id = :category_id");
        $sql->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $sql->execute();
        $prods = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>ID</th><th>Product</th><th>Price</th><th>Image</th><th>&nbsp</th></tr>";
        foreach ($prods as $prod) {
            $table .= "<tr><td>" . $prod['product_id'] . "</td><td>" . $prod['product'] . "</td><td>" . "$" . $prod['price'] . "</td>";
            $table .= "<td><img src='images/" . $prod['image'] . "'></td>";
            $table .= "<td><a href='crudprod.php?action=Edit&prodID=".$prod['product_id']."&Categories=".$prod['category_id']."'>Edit</a> | <a href='crudprod.php?action=Delete&prodID=".$prod['product_id']."'>Delete</a></td></tr>";
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
            die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
        }
}

function viewStoreProducts($db, $category_id){
    try {
        $sql = $db->prepare("SELECT * FROM products WHERE category_id = :category_id");
        $sql->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $sql->execute();
        $prods = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>ID</th><th>Product</th><th>Price</th><th>Image</th><th>&nbsp</th></tr>";
        foreach ($prods as $prod) {
            $table .= "<tr><td>" . $prod['product_id'] . "</td><td>" . $prod['product'] . "</td><td>" . "$" . $prod['price'] . "</td>";
            $table .= "<td><img src='admin/images/" . $prod['image'] . "'></td>";
            $table .= "<td><a href='index.php?action=Add&prodID=".$prod['product_id']."&Categories=".$prod['category_id']."'>Add To Cart</a></td></tr>";
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function addToCart($db, $id){


    try {
        $sql = $db->prepare("SELECT * FROM products WHERE product_id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $prod = $sql->fetch(PDO::FETCH_ASSOC);
        return $prod;

    } catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}






















