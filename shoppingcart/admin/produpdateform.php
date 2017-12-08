<?php
?>
<aside>
    <section>
        <h2>Product Management</h2>
        <form action="prodcrud.php" method="post" enctype="multipart/form-data">
            Category:<select name="Categories">
                <?php echo dropDownForm($categories) ?>
            </select>
            <br />
            Product: <input type="text" name="product" value="<?php echo $prod['product']; ?>"/><br />
            Price: <input type="text" name="price" value="<?php echo $prod['price']; ?>"/><br />
            Image:<input type="file" name="image" id="image"><br />
            <input type="hidden" name="imageOG" value="<?php echo $prod['image']; ?>">
            <input type="hidden" name="pid" value="<?php echo $prod['product_id']; ?>">
            <img src="images/<?php echo $prod['image']; ?>"><br />
            <label>Keep current image?</label>
            <input type="checkbox" name="keepimg" id="keepimg"><br />
            <input type="submit" name="action" value="<?php echo $button ?>">
        </form>
    </section>
</aside>