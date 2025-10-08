<?php

require_once '../../../config/connect.php';
require_once '../../../controllers/generateId.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$fileError = false;
$ferror = [
    "file" => [
        "message" => ""
    ]
];

if (isset($_SESSION['upload-form-error'])) {
    $ferror['file']['message'] = $_SESSION['upload-form-error'];
    $fileError = true;
    unset($_SESSION['upload-form-error']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['upload-btn'])) {

    $current_error = null;


    if (!isset($_FILES['choose-file']) || $_FILES['choose-file']['error'] != 0) {
        $current_error = "Please select a file to upload!";
    } else {
        $tmp = $_FILES['choose-file']['tmp_name'];
        $filename = $_FILES['choose-file']['name'];

        $attempts = 0;
        do {
            $id = generateID('F');
            // SECURITY NOTE: This query is still vulnerable to SQL injection
            $id_query = "SELECT * FROM files WHERE id = '{$id}'";
            $id_exists = mysqli_query($conn, $id_query);
            $attempts++;
        } while (mysqli_num_rows($id_exists) > 0 && $attempts < 5);

        if ($attempts >= 5) {
            $current_error = "Failed to generate a unique ID, please try again!";
        } else {
            $root = $_SERVER['DOCUMENT_ROOT'];
            $upload_dir = $root . '/eduvault/uploads/';
            $path = $upload_dir . basename($filename);

            if (!move_uploaded_file($tmp, $path)) {
                $current_error = "Error: Couldn't move the file to the destination directory.";
            }
        }
    }


    if (!$current_error) {
        $user_id = $_SESSION['user_id'];
        $bytes = $_FILES['choose-file']['size'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $name = pathinfo($filename, PATHINFO_FILENAME);

        if ($bytes < 1048576) {
            $file_size = round($bytes / 1024, 2);
            $size_type = 'KB';
        } else {
            $file_size = round($bytes / 1048576, 2);
            $size_type = 'MB';
        }

        $upload_file = "INSERT INTO files (id, user_id, group_id, file_name, file_type, file_path, file_size, size_type) 
                        VALUES ('$id', '$user_id', '$group_id', '$name', '$extension', '$path', '$file_size', '$size_type')";
        mysqli_query($conn, $upload_file);
    } else {
        $_SESSION['upload-form-error'] = $current_error;
    }

    header("Location: index.php");
    exit();
}
