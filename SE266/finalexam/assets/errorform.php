<?php
?>

<div>
    <h1>Account Sign Up</h1>
    <form action="index.php" method="post">

        <fieldset>
            <legend>Account Information</legend>
            <label>E-Mail:</label>
            <input type="text" name="email" value="<?php echo $email ?>" class="textbox"/>
            <br />

            <label>Phone Number:</label>
            <input type="text" name="phone" value="<?php echo $phone ?>" class="textbox"/>
        </fieldset>

        <fieldset>
            <legend>Settings</legend>

                <?php echo radioForm($heard) ?>

            <p>Contact via:</p>
            <select name="contact_via">
                <?php echo dropDownForm($contact) ?>
            </select>

            <p>Comments: (optional)</p>
            <textarea name="comments" rows="4" cols="50"><?php echo $comments ?></textarea>
        </fieldset>

        <input type="submit" name="action" value="Add" />
        <input type="submit" name="action" value="View" />

    </form>
    <br />
</div>
