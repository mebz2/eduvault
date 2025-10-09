<?php
require_once '../../../config/connect.php';

// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

$edit_error = array();
$editError = false;

// if (isset($_SESSION['edit-group-error'])) {
//     $edit_error = $_SESSION['edit-group-error'];
//     $editError = true;

//     unset($_SESSION['edit-group-error']);
// }

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit-btn'])) {
    $currentError = array();

    $gn = trim(filter_input(INPUT_POST, "group-name", FILTER_SANITIZE_SPECIAL_CHARS));
    $gd = trim(filter_input(INPUT_POST, "group-description", FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($gn) && empty($gd)) {
        header('Location: index.php');
        exit();
    }

    if (!empty($gn)) {
        $new_group_name = $gn;
        $update_name = "UPDATE study_groups SET group_name = '{$new_group_name}'
                        WHERE id = '{$group_id}'
        ";
        mysqli_query($conn, $update_name);
    }

    if (!empty($gd)) {
        $new_group_description = $gd;
        $update_description = "UPDATE study_groups SET group_description = '{$new_group_description}'
                        WHERE id = '{$group_id}'
        ";
        mysqli_query($conn, $update_description);
    }

    header('Location: ../index.php');
    exit();
}
