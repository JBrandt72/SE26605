<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/18/2017
 * Time: 10:23 AM
 */
?>

<form method="post" action="#">
    Corporation Name: <input type="text" name="corpname" value="" /><br /> <!--text boxes for user to enter data -->
    Email: <input type="text" name="email" value="" /><br />
    Zip: <input type="text" name="zip" value="" /><br />
    Owner: <input type="text" name="owner" value="" /><br />
    Phone: <input type="text" name="phone" value="" /><br />


    <input type="submit" id="foo" name="action" value="<?php echo $button; ?>"> <!--submit button to add new record -->
</form>
