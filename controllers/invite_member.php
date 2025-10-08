<?php
// to connect to the database
require_once '../../../config/connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = array(
    "email" => [
        "message" => ""
    ]
);
$memberError = false;

//  check for errors stored in the session 
if (isset($_SESSION['invite-form_error'])) {
    $error['email']['message'] = $_SESSION['invite-form_error'];
    $memberError = true;
    // unset the session variable so the error doesn't show up again on the next reload
    unset($_SESSION['invite-form_error']);
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['invite-btn'])) {
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $current_error = null;

    if (empty($email)) {
        $current_error = "Email is required!";
        $memberError = true;
    } else {
        $find_user = "SELECT id FROM users WHERE email = '{$email}'";
        $result = mysqli_query($conn, $find_user);

        if (mysqli_num_rows($result) == 0) {
            $current_error = "User with this email does not exist!";
            $memberError = true;
        } else {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];

            $already_exists = "SELECT * FROM group_member WHERE user_id = '{$user_id}' AND group_id = '{$group_id}'";
            $exists_result = mysqli_query($conn, $already_exists);

            if (mysqli_num_rows($exists_result) > 0) {
                $current_error = "User is already a member!";
                $memberError = true;
            }
        }
    }

    if ($current_error) {
        $_SESSION['invite-form_error'] = $current_error;
    } else {
        $add_member = "INSERT INTO group_member (group_id, user_id, role) VALUES ('$group_id', '$user_id', 'Member')";
        mysqli_query($conn, $add_member);
    }

    //  always redirect to prevent form resubmission 
    header('Location: index.php');
    exit();
}
