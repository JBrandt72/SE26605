<?php
if(!isset($_SESSION))session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Shopping cart</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    </head>


<?php
    require_once("dbconn.php");
    require_once("functions.php");
    include_once("loginform.php");
    include_once("signupform.php");

    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING) ?? "";
    $conpwd = filter_input(INPUT_POST, 'conpwd', FILTER_SANITIZE_STRING) ?? "";

    $emailLog = filter_input(INPUT_POST, 'emailLogIn', FILTER_SANITIZE_STRING) ?? "";
    $pwdLog = filter_input(INPUT_POST, 'pwdLogIn', FILTER_SANITIZE_STRING) ?? "";

    switch ($action) {
        case 'Sign Up':
            if($pwd === $conpwd && strlen($pwd) > 0) //Checks if password field matches confirm field
            {
                $hash = password_hash($pwd, PASSWORD_DEFAULT);
                echo addUser($db, $email, $hash); //Calls function to get the sorted names for all records
            } else{
                echo "Password fields must match and not be left blank";
            }
            break;
        case 'Log In':
            $user = getUserLogin($db, $emailLog); //Gets login information from db
            if(password_verify($pwdLog, $user['password'])){  //used for validation at login
                $_SESSION['userID']  = $user['user_id'];
                header('Location: admin.php');
            } else {
                echo "<br>Login credentials not valid";
            }

            break;
        case 'LogOut':
            unset($_SESSION['userID']);
            break;
    }


    include_once("adminfooter.php");