<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/7/2017
 * Time: 1:34 PM
 */
?>

<aside>
    <section>
        <h3>Browse Inventory</h3>
        <form method="get" action="index.php">
            <select name="Categories">
                <?php echo dropDownForm($categories) ?>
            </select>
            <input type="submit" name="action" value="View">
        </form>
    </section>
</aside>

