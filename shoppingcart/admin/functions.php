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

        if($_GET['Categories'] == $cat['category_id']){
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

function deleteProduct($db, $id){  //Function to delete a record from the database
    try {
        $sql = $db->prepare("DELETE FROM products WHERE category_id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        return "Record " . $id ." deleted.";
    } catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}