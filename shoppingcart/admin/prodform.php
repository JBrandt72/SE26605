<?php

?>


<section>
    <h2>Product Management</h2>
    <form action="crudprod.php" method="post" enctype="multipart/form-data">
        Category:<select name="Categories">
            <?php echo dropDownForm($categories) ?>
        </select><br />
        Product: <input type="text" name="product" value=""/><br />
        Price: <input type="text" name="price" value=""/><br />
        Image:<input type="file" name="image" id="image"><br />
        <input type="submit" name="action" value="<?php echo $button ?>">
    </form>

</section>
