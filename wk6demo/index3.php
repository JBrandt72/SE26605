<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/6/2017
 * Time: 10:17 AM
 */
session_start();
//login verification begins here
$_SESSION['username'] = "Jon";
header('Location: foo.php');


/* $cart []; empty array                 oftent stored as session var
    $product = [id, name, price, qty]    store in cart