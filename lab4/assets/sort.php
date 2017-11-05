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
    <select name ="id">
        <option value="id">ID</option>
        <option value="corp">Corp</option>
        <option value="date">Date</option>
        <option value="email">Email</option>
        <option value="zip">Zip</option>
        <option value="owner">Owner</option>
        <option value="phone">Phone</option>
    </select>
    Ascending:<input type="radio" name="sorting" value ="ascending">
    Descending:<input type="radio" name="sorting" value ="descending">
    <input type="submit" name="action" value="Submit">
    <input type="submit" name="action" value="Reset">
</form>
