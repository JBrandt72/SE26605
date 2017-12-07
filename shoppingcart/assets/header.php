<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/29/2017
 * Time: 10:49 AM
 */

    if(isset($_SESSION['cart'])) {
        $cartItemCount = count($_SESSION['cart']);
    } else {
        $cartItemCount = "";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- css links go here -->
    <!-- js links go here -->
</head>
<body>
<header style="text-align:center">
    <h1>Vintage Gear</h1>
    <a href="index.php">Inventory</a> |
    <a href="index.php?action=Cart">Cart <sup><?php echo $cartItemCount; ?></sup></a>
</header>
<section>