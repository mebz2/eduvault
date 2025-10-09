<?php
require_once '../../../config/connect.php';

// this script get the information for the group you are in right now (after you click on one of the groups)

//get admin
$fetch_admin = "SELECT user_id FROM group_member WHERE group_id = '{$group_id}' AND role = 'Admin'";
$admin_result = mysqli_query($conn, $fetch_admin);
if ($row = mysqli_fetch_assoc($admin_result)) {
    $admin_id = $row['user_id'];
}

//get member count
$fetch_info = "SELECT COUNT(*) AS member_count
                FROM group_member
                WHERE group_id = '{$group_id}'
";

$result = mysqli_query($conn, $fetch_info);

if ($row = mysqli_fetch_assoc($result)) {
    $member_count = $row['member_count'];
}


//get group description
$fetch_description = "SELECT group_description FROM study_groups WHERE id = '{$group_id}'";
$description_result = mysqli_query($conn, $fetch_description);

if ($row = mysqli_fetch_assoc($description_result)) {
    $group_description = $row['group_description'];
} else {
    $group_description = "NO DESCRIPTION";
}


//get members
$members = array();
$fetch_members = "SELECT gm.user_id AS user_id, 
                     u.username AS username,
                     gm.role AS role
                     FROM group_member gm
                     JOIN users u ON gm.user_id = u.id
                     WHERE gm.group_id = '{$group_id}'
";

$member_result = mysqli_query($conn, $fetch_members);
if (mysqli_num_rows($member_result)) {
    // store members and member information in an array
    while ($row = mysqli_fetch_assoc($member_result)) {
        $members[$row['user_id']] = [
            "username" => $row['username'],
            "role" => $row['role']
        ];
    }
}

//get files
$files = array();
$fetch_files = "SELECT * FROM files 
                WHERE group_id = '{$group_id}'
";
$file_result = mysqli_query($conn, $fetch_files);
if (mysqli_num_rows($file_result)) {
    // store files and file information in an array
    while ($row = mysqli_fetch_assoc($file_result)) {
        $files[$row['id']] = [
            "file_name" => $row['file_name'],
            "file_path" => $row['file_path'],
            "file_type" => $row['file_type'],
            "file_size" => $row['file_size'],
            "size_type" => $row['size_type'],
        ];
    }
}
