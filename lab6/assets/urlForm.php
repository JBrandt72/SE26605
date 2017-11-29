<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/13/2017
 * Time: 8:30 AM
 */

$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;

?>
<form method="get" action="#">
    <input type="text" name="url" id ="url" value="<?php echo $url?>">
    <input type="submit" name="action" value="Add">
</form>
