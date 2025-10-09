<?php
require_once '../config/connect.php';


// an associative array of flags to store possible errors
$error = array();
$login_error = false; // flag i use to check if there are errors

// start a session if one isn't currently running
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if there are errors during login 
// (this is here b/c when the page is redirected here using GET the textboxes will display the errors)
if (isset($_SESSION['login-errors'])) {
    $error = $_SESSION['login-errors'];
    $login_error = true;
    unset($_SESSION['login-errors']);
}

// if the request method is POST and the login button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $currentError = array();

    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $pass = $_POST["password"];

    if (empty($email)) {
        $currentError['err']['id'] = "email";
        $currentError['err']['message'] = "Email is required!";
        $login_error = true;
    } elseif (empty($pass)) {
        $currentError['err']['id'] = "password";
        $currentError['err']['message'] = "Password is required!";
        $login_error = true;
    } else {
        $find_user = "SELECT * FROM users WHERE email = '{$email}'";
        $user_result = mysqli_query($conn, $find_user);

        if (mysqli_num_rows($user_result) == 0) {

            $currentError['err']['id'] = "email";
            $currentError['err']['message'] = "User does not exist!";
            $login_error = true;
        } else {

            $user = mysqli_fetch_assoc($user_result);

            $username = $user['username'];
            $user_id = $user['id'];
            $hash_password = $user['password'];

            if (!password_verify($pass, $hash_password)) {
                $currentError['err']['id'] = "password";
                $currentError['err']['message'] = "Password is incorrect!";
                $login_error = true;
            }
        }
    }

    // if there are no errors set the SESSION variables for username and user id
    // and redirect to the homepage
    if (!$login_error) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        header("Location: homepage.php");
        exit();
    }

    // else set login-errors SESSION variable to the error message and 
    // redirect back to the same page (this will rerun this script and the first if statement is run)
    else {
        $_SESSION['login-errors'] = $currentError;
        header("Location: login.php");
        exit();
    }
}
