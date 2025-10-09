<?php

require_once '../../../config/connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['leave-grp-btn'])) {
    $leave_query = "DELETE FROM group_member WHERE group_id = '{$group_id}' AND user_id = '{$_SESSION['user_id']}' ";
    mysqli_query($conn, $leave_query);
    header("Location: ../index.php");
    exit();
}
