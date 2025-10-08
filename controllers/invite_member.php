<?php
// to connect to the database
require_once '../../../config/connect.php';

$error = array(
    "email" => [
        "message" => ""
    ]
);


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentError = null;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['invite-btn'])) {
    if (!isset($_SESSION["invite-member-submitted"])) {
        $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));

        if (empty($email)) {
            $error["email"]["message"] = "Email is required!";
            $currentError = true;
        }

        if (empty($currentError)) {
            // check if the user does not exist
            $find_user = "SELECT id FROM users WHERE email = '{$email}'";
            $result = mysqli_query($conn, $find_user);

            if (mysqli_num_rows($result) == 0) {
                $error['email']['message'] = "User with this email does not exist!";
                $currentError = true;
            } else {
                // if the user exists check if the user is already a member
                $get_user_id = "SELECT id FROM users WHERE email = '{$email}'";
                $id_result = mysqli_query($conn, $get_user_id);

                $row = mysqli_fetch_assoc($id_result);
                $user_id = $row['id'];

                $already_exists = "SELECT * FROM group_member WHERE user_id = '{$user_id}' AND group_id = '{$group_id}'";
                $exists_result = mysqli_query($conn, $already_exists);

                if (mysqli_num_rows($exists_result)) {
                    $error['email']['message'] = "User is already a member!";
                    $currentError = true;
                }
            }
        }


        // if the email passes all the checks insert it into the group_member table
        if (empty($currentError)) {
            $get_user_id = "SELECT id FROM users WHERE email = '{$email}'";
            $id_result = mysqli_query($conn, $get_user_id);
            $row = mysqli_fetch_assoc($id_result);
            $user_id = $row['id'];
            $add_member = "INSERT INTO group_member (group_id, user_id, role) VALUES ('$group_id', '$user_id', 'Member')";
            mysqli_query($conn, $add_member);
            $_SESSION['invite-member-submitted'] = true;
            header('Location: index.php');
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    unset($_SESSION["invite-member-submitted"]);
}
