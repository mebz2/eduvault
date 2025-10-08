<?php
session_start();
//only set the variables when the user first enters the page
if (!isset($_SESSION['group_id']) && isset($_GET['id']) && isset($_GET['name'])) {
    $_SESSION['group_id'] = $_GET['id'];
    $_SESSION['group_name'] = $_GET['name'];
}

$group_id = $_SESSION['group_id'];
$group_name = $_SESSION['group_name'];

require_once '../../../helper/auth.php'; // to login the user if they are not logged in
requireLogin();

require_once '../../../controllers/fetch_group_info.php';
include '../../../controllers/invite_member.php';
include '../../../controllers/upload_file.php';

$stylesheets = array(
    '../../../assets/css/group.css',
    '../../../assets/css/popup.css',
    '../../../assets/css/textbox.css',
    '../../../assets/css/member.css',
    '../../../assets/css/files.css',
    '../../../assets/css/upload-file.css',
    '../../../assets/css/textbox.css'
);

$title = $group_name;

require_once '../../../layout/header.php';
?>
<div class="parent <?= ($memberError || $fileError) ? 'blur' : '' ?>" id="parent">
    <div class="navbar">
        <div class="logo">
            <a href="../index.php" class="back">
                <div>
                    <img src="../../../assets/icons/left-arrow.png" />
                </div>
            </a>
            <div>
                <p class="brand-name"><?= $group_name ?></p>
            </div>
        </div>
    </div>

    <div class="main-div">
        <div class="group-info">
            <p class="group-description"><?= $group_description ?></p>
            <div>
                <img src="../../../assets/icons/user-avatar.png" class="member-image">
                <p><?php echo $member_count . " ";
                    echo ($member_count == 1) ? 'member' : 'members' ?> </p>
            </div>
        </div>

        <div class="button-container">
            <button onclick="showContent('members', this)" class="button active-btn">Members</button>
            <button onclick="showContent('files', this) " class="button">Files</button>
        </div>

        <div class="content">
            <div id="members" class="contents active">
                <div class="members-header">
                    <h1>Group Members(<?= $member_count ?>)</h1>
                    <button id="invite-members-btn">Invite Members</button>
                </div>
                <?php
                foreach ($members as $id => $member) {
                    $username = $member['username'];
                    $role = $member['role'];
                    include '../../../components/group_member.php';
                }
                ?>
            </div>
            <div id="files" class="contents">
                <div class="files-header">
                    <h1>Shared Files</h1>
                    <button id="upload-file-button">Upload File</button>
                </div>
                <?php
                foreach ($files as $id => $file) {
                    $file_path = $file['file_path'];
                    if (file_exists($file_path)) { // check if the file exists in the uploads directory
                        $file_name = $file['file_name'];
                        $file_size = $file['file_size'];
                        $size_type = $file['size_type'];
                        $file_type = $file['file_type'];

                        include '../../../components/group_file.php';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
//invite members popup
require_once '../../../components/invite_members_popup.php';
//upload file popup
require_once '../../../components/upload_file_popup.php';
?>



<?php
// footer
$scripts = array(
    '../../../assets/js/showcontent.js',
    '../../../assets/js/group.js',
);
require_once '../../../layout/footer.php';
mysqli_close($conn);
?>