<?php
require_once '../../controllers/generateId.php'; // for the function that generates ids
require_once '../../config/connect.php'; // to connect to the database

$error = array(
    "group_name" => [
        "id" => "group_name",
        "message" => ""
    ],
    "group_description" => [
        "id" => "group_description",
        "message" => ""
    ],
);

$currentError = null;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create-button"])) {
    if (!isset($_SESSION["group_form_submitted"])) {
        $group_name = trim(filter_input(INPUT_POST, "group-name", FILTER_SANITIZE_SPECIAL_CHARS));
        $group_description = trim(filter_input(INPUT_POST, "group-description", FILTER_SANITIZE_SPECIAL_CHARS));

        if (empty($group_name)) {
            $error["group_name"]["message"] = "Group name is required!";
            $currentError = "group_name";
        } elseif (empty($group_description)) {
            $error["group_description"]["message"] = "Group description is required!";
            $currentError = "group_description";
        }
        // if there are no errors
        if (!$currentError) {
            //generate random id
            $attempts = 0;
            do {
                $id = generateID('G');
                $id_query = "SELECT * FROM study_groups WHERE id = '{$id}'";
                $id_exists = mysqli_num_rows(mysqli_query($conn, $id_query));
                $attempts++;
            } while ($id_exists && $attempts < 5);


            // if it fails to generate a random id tell the user to try again
            if ($attempts >= 5) {
                array_push($error, "Failed to generate random id, please try again :)");
            } else {
                $user_id = $_SESSION["user_id"];
                $create_group = "INSERT INTO study_groups (id, group_name, group_description, group_creator) VALUES('$id', '$group_name', '$group_description', '$user_id')";
                mysqli_query($conn, $create_group);

                $add_member = "INSERT INTO group_member (group_id, user_id, role) VALUES('$id', '$user_id', 'admin')";
                mysqli_query($conn, $add_member);

                // mark form as submitted to stop resubmission in reloads
                $_SESSION["group_form_submitted"] = true;

                // header('Location: index.php');
                // exit();
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    unset($_SESSION["group_form_submitted"]);
}

mysqli_close($conn); //close connectiong