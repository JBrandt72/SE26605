<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/4/2017
 * Time: 10:32 PM
 */
?>

<section>
    <h2>Category Management</h2>
    <form method="get" action="#">
        <select name="Categories">
            <?php echo dropDownForm($categories) ?>
         </select>
        <input type="submit" name="action" value="Edit">
        <input type="submit" name="action" value="Delete">
        <input type="submit" name="action" value="View">
    </form>
</section>