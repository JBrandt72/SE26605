<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 10/23/2017
 * Time: 11:03 AM
 */

    require_once("dbconn.php");
    require_once("corps.php"); //
    include_once("header.php");

    $db = dbConn();
    $id = filter_input(INPUT_GET, 'id'); //Gets id from url
    $button = "Update";
    $corp = getCorpStats($db, $id);

?>
    <a href='../index.php'>Return to View Page</a><br /> <!--Link to return to view page-->

    <form method="post" action="#">
        Corporation Name: <input type="text" name="corpname" value="<?php echo $corp['corp']; ?>" /><br /> <!--text boxes for user to enter data -->
        Email: <input type="text" name="email" value="<?php echo $corp['email']; ?>" /><br />
        Zip: <input type="text" name="zip" value="<?php echo $corp['zipcode']; ?>" /><br />
        Owner: <input type="text" name="owner" value="<?php echo $corp['owner']; ?>" /><br />
        Phone: <input type="text" name="phone" value="<?php echo $corp['phone']; ?>" /><br />

        <input type="submit" id="foo" name="action" value="<?php echo $button; ?>"> <!--submit button to add new record -->
    </form>

<?php
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
    $corpname = filter_input(INPUT_POST, 'corpname', FILTER_SANITIZE_STRING) ?? "";   //Saves user input to variables
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

    switch($action) {
        case "Update":
            echo updateRecord($db, $id, $corpname, $email, $zip, $owner, $phone); //Switch to call function to update record (wanted to try both methods)
            echo getCorp($db, $id);
            break;
    }

    include_once ("footer.php");
?>

