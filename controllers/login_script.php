<?php
require_once '../config/connect.php';


// an associative array of flags to store possible errors
$error = array();
$login_error = false;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['login-errors'])) {
    $error = $_SESSION['login-errors'];
    $login_error = true;
    unset($_SESSION['login-errors']);
}

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

    if (!$login_error) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        header("Location: homepage.php");
        exit();
    } else {
        $_SESSION['login-errors'] = $currentError;
        header("Location: login.php");
        exit();
    }
}
