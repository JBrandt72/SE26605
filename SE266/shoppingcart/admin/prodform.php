<?php

?>

<aside>
    <section>
        <h2>Product Management</h2>
        <form action="prodcrud.php" method="post" enctype="multipart/form-data">
            Category:<select name="Categories">
                <?php echo dropDownForm($categories) ?>
            </select>
            <input type="submit" name="action" value="View"><br />
            Product: <input type="text" name="product" value=""/><br />
            Price: <input type="text" name="price" value=""/><br />
            Image:<input type="file" name="image" id="image"><br />
            <input type="submit" name="action" value="<?php echo $button ?>">
        </form>

    </section>
</aside>
