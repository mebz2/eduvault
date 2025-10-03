<?php
require_once '../config/connect.php';


// an associative array of flags to store possible errors
$error = array(
    "empty_email" => [
        "id" => "email",
        "message" => "Email is required!"
    ],
    "empty_password" => [
        "id" => "password",
        "message" => "Password is required!"
    ],
    "password_mismatch" => [
        "id" => "password",
        "message" => "Incorrect password"
    ],
    "wrong_email" => [
        "id" => "email",
        "message" => "User with this email doesn't exist"
    ],
);

$currentError = null;
if (isset($_POST["login"])) {
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $pass = $_POST["password"];

    if (empty($email)) {
        $currentError = "empty_email";
    } elseif (empty($pass)) {
        $currentError = "empty_password";
    } else {
        $find_user = "SELECT * FROM users WHERE email = '{$email}'";
        $user_result = mysqli_query($conn, $find_user);
        if (mysqli_num_rows($user_result) > 0) {
            $user = mysqli_fetch_assoc($user_result);

            $username = $user['username'];
            $user_id = $user['id'];
            $hash_password = $user['password'];

            if (!password_verify($pass, $hash_password)) {
                $currentError = "password_mismatch";
            }
        } else {
            $currentError = "wrong_email";
        }
    }

    if (!$currentError) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        mysqli_close($conn);
        header("Location: homepage.php");
        exit();
    }
}



mysqli_close($conn);
