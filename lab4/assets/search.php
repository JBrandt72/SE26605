<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 11/5/2017
 * Time: 12:47 PM
 */
function getAllCorps($db){
    $sql = "SELECT * FROM corps";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function dropDownForm($corps){
    $form = "<form>" . PHP_EOL;
    $form .= "<select name ='deptID'>" . PHP_EOL;
    foreach($corps as $corp){
        $form .= "<option value='" . $corp['id'] . "'>";
        $form .= $corp['id'] . "</option>";
    }
    $form .= "</select>" . PHP_EOL;
    $form .= "</form>";
    return $form;

}

?>

<form method="get">
    Search Column:
    <select name ="colSearch">
        <option value="id">ID</option>
        <option value="corp">Corp</option>
        <option value="date">Date</option>
        <option value="email">Email</option>
        <option value="zip">Zip</option>
        <option value="owner">Owner</option>
        <option value="phone">Phone</option>
    </select>
    Term:<input type="text" name="term" id ="term">
    <input type="submit" value="Submit">
    <input type="hidden" name="action" value="search">
    <input type="submit" name="action" value="Reset">
</form>
