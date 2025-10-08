<?php
require_once '../config/connect.php';
require_once '../controllers/generateId.php';

$error = array();
$sign_up_error = false;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['signup-error'])) {
    $error = $_SESSION['signup-error'];
    $sign_up_error = true;
    unset($_SESSION['signup-error']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["signup"])) {
    $currentError = array();

    // sanitize username and email so that the user cannot enter malicious scripts
    $usern = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];


    // check if all the text boxes are filled
    if (empty($usern)) {
        $currentError["err"]["id"] = "username";
        $currentError["err"]["message"] = "Username is required!";
        $sign_up_error = true;
    } elseif (empty($email)) {
        $currentError["err"]["id"] = "email";
        $currentError["err"]["message"] = "Email address is required!";
        $sign_up_error = true;
    } elseif (empty($pass)) {
        $currentError["err"]["id"] = "password";
        $currentError["err"]["message"] = "Password is required!";
        $sign_up_error = true;
    } elseif (empty($cpass)) {
        $currentError["err"]["id"] = "cpassword";
        $currentError["err"]["message"] = "Confirmation password is required!";
        $sign_up_error = true;
    }
    //check if the length of the password exceeds the minimum
    elseif (strlen($pass) < 8) {
        $currentError["err"]["id"] = "password";
        $currentError["err"]["message"] = "Password is required!";
        $sign_up_error = true;
    }
    // check if passwords match
    elseif (strcmp($pass, $cpass)) {
        $currentError["err"]["id"] = "cpassword";
        $currentError["err"]["message"] = "Password and confirmation password do not match!";
        $sign_up_error = true;
    }
    //check length of username
    elseif (strlen($usern) > 20) {
        $currentError["err"]["id"] = "username";
        $currentError["err"]["message"] = "Username is too long, maximum of 20 characters!";
        $sign_up_error = true;
    }
    //check if email is already in the database
    else {
        $email_query = "SELECT * FROM users WHERE email = '{$email}'";
        $email_result = mysqli_query($conn, $email_query);
        if (mysqli_num_rows($email_result) > 0) {
            $currentError["err"]["id"] = "email";
            $currentError["err"]["message"] = "A user with this email already exists!";
            $sign_up_error = true;
        } else {
            $attempts = 0;
            do {
                $id = generateID('U');
                $id_query = "SELECT * FROM users WHERE id = '{$id}'";
                $id_exists = mysqli_query($conn, $id_query);
                $attempts++;
            } while (mysqli_num_rows($id_exists) > 0 && $attempts < 5);

            // if it fails to generate a random id tell the user to try again
            if ($attempts >= 5) {
                $currentError["err"]["id"] = "username";
                $currentError["err"]["message"] = "Failed to generate a unique ID, please try again!";
                $sign_up_error = true;
            }
        }
    }



    //if there are no errors
    if (!$sign_up_error) {
        $hashpass = password_hash($pass, PASSWORD_DEFAULT); // hash the password
        $sql = "INSERT INTO users (id, email, username, password) VALUES ('$id', '$email', '$usern', '$hashpass')"; //query to create a user
        mysqli_query($conn, $sql);

        $_SESSION["user_id"] = $id;
        $_SESSION["username"] = $usern; //put the username in the session global variable

        header("Location: homepage.php");
        exit();
    } else {
        $_SESSION['signup-error'] = $currentError;
        header("Location: signup.php");
        exit();
    }
}
