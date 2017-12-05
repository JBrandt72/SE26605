<?php

?>


<section>
    <form action="crudcat.php" method="post">
        Category: <input type="text" name="category" value="<?php echo $selectedcat ?>"/><br />
        <input type="submit" name="action" value="<?php echo $button ?>">
    </form>
</section>