<?php
/**
 * Created by PhpStorm.
 * User: 005501496
 * Date: 11/29/2017
 * Time: 11:03 AM
 */

    require_once("../assets/dbconn.php");
    include_once("../assets/header.php");
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
            if($pwd === $conpwd && strlen($pwd) > 0)
            {
                $hash = password_hash($pwd, PASSWORD_DEFAULT);
                echo addUser($db, $email, $hash); //Calls function to get the sorted names for all records
            } else{
                echo "Password fields must match and not be left blank";
            }
            break;
        case 'Log In':
            $user = getUserLogin($db, $emailLog);
            //echo $user['password'];
            if(password_verify($pwdLog, $user['password'])){  //used for validation at login
                echo "valid";

                session_start(); //indicates that this script will need access to session vars
                $_SESSION['userID']  = $user['user_id'];

            } else {
                echo "invalid";
            }

            break;
    }


    include_once("../assets/footer.php");