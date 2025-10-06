<?php
require_once '../../config/connect.php'; // to connect to the database
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION["user_id"]; //[x]
$fetch_query = "
    SELECT gm.group_id, g.group_name, g.id, g.group_description
    FROM group_member gm
    JOIN study_groups g ON gm.group_id = g.id
    WHERE gm.user_id = '{$user_id}'
"; //[x]
$result = mysqli_query($conn, $fetch_query); //[x]
$groups = array(); //[x]

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $groups[$row['group_name']] = $row['group_description']; //[x]
    }
} else {
    $no_groups = true;
}

// foreach ($groups as $name => $description) {
//     echo $name . "=>" . $description . "<br>";
// }
