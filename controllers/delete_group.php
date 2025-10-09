<?php
require_once '../../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete-grp-btn'])) {
    $delete_query = "DELETE FROM study_groups WHERE id = '{$group_id}'";
    mysqli_query($conn, $delete_query);
    header("Location: ../index.php");
    exit();
}
