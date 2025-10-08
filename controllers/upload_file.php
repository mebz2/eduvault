<?php

require_once '../../../config/connect.php';
require_once '../../../controllers/generateId.php';

$fileError = null;
$ferror = array(
    "file" => [
        "message" => ""
    ]
);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['upload-btn'])) {

    if (isset($_FILES['choose-file']) && $_FILES['choose-file']['error'] == 0) {

        // user and group information ( the group id is already set in the group page )
        $user_id = $_SESSION['user_id'];

        // file information
        $filename = $_FILES['choose-file']['name'];
        $tmp = $_FILES['choose-file']['tmp_name']; // where the server stores the file temporarily 
        $bytes = $_FILES['choose-file']['size']; // size in bytes

        // file size in mbs or kbs
        if ($bytes < 1048576) {
            $file_size = round($bytes / 1024, 2);
            $size_type = 'KB';
        } else {
            $file_size = round($bytes / 1048576, 2);
            $size_type = 'MB';
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION); // returns the file extension
        $name = pathinfo($filename, PATHINFO_FILENAME); // returns the file name without extension

        // directory where file is uploaded
        $root = $_SERVER['DOCUMENT_ROOT'];
        $upload_dir = $root . '/eduvault/uploads/';
        $path = $upload_dir . basename($filename);

        // generate an id and if the id already exists try again (max of 5 times)
        $attempts = 0;
        do {
            $id = generateID('F');
            $id_query = "SELECT * FROM files WHERE id = '{$id}'";
            $id_exists = mysqli_query($conn, $id_query);
            $attempts++;
        } while (mysqli_num_rows($id_exists) > 0 && $attempts < 5);

        // if it fails to generate a random id tell the user to try again
        if ($attempts >= 5) {
            $ferror["file"]["message"] = "Failed to generate a unique ID, please try again!";
            $fileError = true;
        }


        // moves it from tmp to path, from the temporary location to the location i give it
        if (move_uploaded_file($tmp, $path) && !isset($fileError)) {
            $upload_file = "INSERT INTO files (id, user_id, group_id, file_name, file_type, file_path, file_size, size_type) 
                            VALUES ('$id', '$user_id', '$group_id', '$name', '$extension', '$path', '$file_size', '$size_type')";
            mysqli_query($conn, $upload_file);
            $fileError = false;
            header("Location: index.php");
            exit();
        } else {
            $fileError = true;
            $ferror['file']['message'] = "Couldn't move the file to the uploads directory!";
        }
    } else {
        $fileError = true;
        $ferror['file']['message'] = "Select a file!";
    }
}
