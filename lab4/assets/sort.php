<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 11/5/2017
 * Time: 12:47 PM
 */
?>

<form method="get">
    Sort Column:
    <select name ="colSort" value="id">
        <option value="id">ID</option>
        <option value="corp">Corp</option>
        <option value="incorp_dt">Date</option>
        <option value="email">Email</option>
        <option value="zipcode">Zip</option>
        <option value="owner">Owner</option>
        <option value="phone">Phone</option>
    </select>
    Ascending:<input type="radio" name="dir" value ="ASC">
    Descending:<input type="radio" name="dir" value ="DESC">
    <input type="submit" value="Submit">
    <input type="hidden" name="action" value="sort">
    <input type="submit" name="action" value="Reset">
</form>
