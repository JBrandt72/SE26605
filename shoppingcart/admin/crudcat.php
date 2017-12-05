<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/4/2017
 * Time: 6:44 PM
 */

    require_once("dbconn.php");
    include_once("adminheader.php");
    require_once("functions.php");

    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??          //Saves all user input to variables
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $categories = getAllCats($db);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING) ?? "";
    $button = "Add";
?>


<section>
    <form method="get" action="#">
        <select name="Categories">
            <?php echo dropDownForm($categories) ?>
        </select>
        <input type="submit" name="action" value="Edit">
    </form>
    <form method="post" action="#">
        Category: <input type="text" name="category" value=""/><br />
        <input type="submit" name="action" value="<?php echo $button; ?>">
    </form>
</section>




<?php
    if($action == "Add") {
        echo addCategory($db, $category); //If statement to call function to add new record
    }

switch ($action) {
    case 'Add':
        echo addCategory($db, $category); //If statement to call function to add new record
        break;
    case 'Edit':
        $button = "Update";

        break;
}