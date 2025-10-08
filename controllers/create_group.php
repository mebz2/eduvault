<?php
require_once '../../controllers/generateId.php'; // for the function that generates ids
require_once '../../config/connect.php'; // to connect to the database

$error = array();
$create_group_error = false;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['create-group-error'])) {
    $error = $_SESSION['create-group-error'];
    $create_group_error = true;

    unset($_SESSION['create-group-error']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create-button"])) {

    $currentError = array();

    $group_name = trim(filter_input(INPUT_POST, "group-name", FILTER_SANITIZE_SPECIAL_CHARS));
    $group_description = trim(filter_input(INPUT_POST, "group-description", FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($group_name)) {
        $currentError['err']['id'] = "group_name";
        $currentError['err']['message'] = "Group name is required!";
        $create_group_error = true;
    } elseif (empty($group_description)) {
        $currentError['err']['id'] = "group_description";
        $currentError['err']['message'] = "Group description is required!";
        $create_group_error = true;
    } else {
        //generate random id
        $attempts = 0;
        do {
            $id = generateID('G');
            $id_query = "SELECT * FROM study_groups WHERE id = '{$id}'";
            $id_exists = mysqli_query($conn, $id_query);
            $attempts++;
        } while (mysqli_num_rows($id_exists) > 0 && $attempts < 5);

        if ($attempts >= 5) {
            $currentError['err']['id'] = "group_name";
            $currentError['err']['message'] = "Failed to generate a unique id try again!";
            $create_group_error = true;
        }
    }

    if (!$create_group_error) {
        $user_id = $_SESSION["user_id"];
        $create_group = "INSERT INTO study_groups (id, group_name, group_description, group_creator) VALUES('$id', '$group_name', '$group_description', '$user_id')";
        mysqli_query($conn, $create_group);

        $add_member = "INSERT INTO group_member (group_id, user_id, role) VALUES('$id', '$user_id', 'admin')";
        mysqli_query($conn, $add_member);
    } else {
        $_SESSION['create-group-error'] = $currentError;
    }

    header('Location: index.php');
    exit();
}
