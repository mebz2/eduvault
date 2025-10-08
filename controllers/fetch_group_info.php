<?php
require_once '../../../config/connect.php';
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
    while ($row = mysqli_fetch_assoc($member_result)) {
        $members[$row['user_id']] = [
            "username" => $row['username'],
            "role" => $row['role']
        ];
    }
}
