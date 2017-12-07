<?php

?>
<section>
    <h2>Category Management</h2>
    <form method="get" action="catcrud.php">
        <select name="Categories">
            <?php echo dropDownForm($categories) ?>
        </select>
        <input type="submit" name="action" value="Edit">
        <input type="submit" name="action" value="Delete">
        <input type="submit" name="action" value="View">
    </form>
</section>
<section>
    <form action="catcrud.php" method="post">
        Category: <input type="text" name="category" value="<?php echo $selectedcat ?>"/><br />
        <input type="submit" name="action" value="<?php echo $button ?>">
    </form>
</section>