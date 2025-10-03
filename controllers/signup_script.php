<?php
require_once '../config/connect.php';
require_once '../controllers/generateId.php';

$error = array(
    "username" => [
        "id" => "username",
        "message" => ""
    ],

    "email" => [
        "id" => "email",
        "message" => ""
    ],

    "password" => [
        "id" => "password",
        "message" => ""
    ],

    "cpassword" => [
        "id" => "cpassword",
        "message" => ""
    ],
);

$currentError = null;

if (isset($_POST["signup"])) {
    // sanitize username and email so that the user cannot enter malicious scripts
    $usern = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];


    // check if all the text boxes are filled
    if (empty($usern)) {
        $error["username"]["message"] = "Username is required!";
        $currentError = "username";
    } elseif (empty($email)) {
        $error["email"]["message"] = "Email address is required!";
        $currentError = "email";
    } elseif (empty($pass)) {
        $error["password"]["message"] = "Password is required!";
        $currentError = "password";
    } elseif (empty($cpass)) {
        $error["cpassword"]["message"] = "Confirmation password is required!";
        $currentError = "cpassword";
    }
    //check if the length of the password exceeds the minimum
    elseif (strlen($pass) < 8) {
        $error["password"]["message"] = "Password is required!";
        $currentError = "password";
    }
    // check if passwords match
    elseif (strcmp($pass, $cpass)) {
        $error["cpassword"]["message"] = "Password and confirmation password do not match!";
        $currentError = "cpassword";
    }
    //check length of username
    elseif (strlen($usern) > 20) {
        $error["username"]["message"] = "Username is too long, maximum of 20 characters!";
        $currentError = "username";
    }
    //check if email is already in the database
    else {
        $email_query = "SELECT * FROM users WHERE email = '{$email}'";
        $email_result = mysqli_query($conn, $email_query);
        if (mysqli_num_rows($email_result) > 0) {
            $error["email"]["message"] = "A user with this email already exists!";
            $currentError = "email";
        }
    }



    //if there are no errors
    if (!$currentError) {
        // generate an id and if the id already exists try again (max of 5 times)
        $attempts = 0;
        do {
            $id = generateID('U');
            $id_query = "SELECT * FROM users WHERE id = '{$id}'";
            $id_exists = mysqli_query($conn, $id_query);
            $attempts++;
        } while (mysqli_num_rows($id_exists) > 0 && $attempts < 5);

        // if it fails to generate a random id tell the user to try again
        if ($attempt >= 5) {
            $error["username"]["message"] = "Failed to generate a unique ID, please try again!";
            $currentError = "username";
        } else {
            $hashpass = password_hash($pass, PASSWORD_DEFAULT); // hash the password
            $sql = "INSERT INTO users (id, email, username, password) VALUES ('$id', '$email', '$usern', '$hashpass')"; //query to create a user
            mysqli_query($conn, $sql);
            session_start();
            $_SESSION["username"] = $usern; //put the username in the session global variable
            mysqli_close($conn); //close the connection before redirecting
            header("Location: homepage.php");
            exit();
        }
    }
}

mysqli_close($conn);
