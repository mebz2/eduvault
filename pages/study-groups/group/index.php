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
                include '../../../components/file.php';
                ?>
            </div>
        </div>
    </div>
</div>


<!-- invite members popup -->

<div id="member-popup" class="member-popup" style="display: <?= ($memberError) ? 'block' : 'none'; ?>;">
    <div class="popup-content" id="popup-content">
        <form action="index.php" method="post" id="invite-member-form">
            <div>
                <h2>Invite Members</h2>
                <p class="tagline">Send invitation to join "<?= $group_name ?>" study group</p>
                <div class="close-button" id="close-member-button">
                    <img src="../../../assets/icons/close.png" alt="" class="close-image">
                </div>
            </div>

            <?php
            $label = "Email Address";
            $type = "email";
            $name = "email";
            include '../../../components/textfield.php';
            ?>
            <div class="error-text">
                <?php echo ($memberError) ? $error['email']['message'] : '' ?>
            </div>
            <div>
                <input type="submit" value="Invite Member" name="invite-btn">
            </div>
        </form>
    </div>
</div>


<!-- upload file popup -->
<!-- <div id="file-popup" class="file-popup" style="display: <?= ($fileError) ? 'block' : 'none'; ?>;"> -->
<div id="file-popup" class="file-popup" style="display: none;">
    <div class="popup-content">
        <form action="index.php" method="post" id="file-upload-form">
            <div>
                <h2>Upload File</h2>
                <p class="tagline">Share study material with your group</p>
                <div class="close-button" id="close-file-button">
                    <img src="../../../assets/icons/close.png" alt="" class="close-image">
                </div>
            </div>
            <div>
                <label for="choose-file" class="choose-file">
                    Choose File
                </label>
                <input type="file" id="choose-file" name="choose-file">
                <p id="filename">No file selected</p>
            </div>
            <div>
                <input type="submit" value="Upload File" name="upload-btn">
            </div>
        </form>
    </div>
</div>

<?php
$scripts = array(
    '../../../assets/js/showcontent.js',
    '../../../assets/js/group.js',
);
require_once '../../../layout/footer.php';
mysqli_close($conn);
?>