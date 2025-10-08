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
    '../../../assets/css/member-popup.css',
    '../../../assets/css/textbox.css'
);
$title = $group_name;

require_once '../../../layout/header.php';
?>
<div class="parent <?= ($currentError) ? 'blur' : '' ?>" id="parent">
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
                <h1>Files</h1>
            </div>
        </div>
    </div>
</div>


<!-- invite members popup -->

<div id="member-popup" class="member-popup" style="display: <?= ($currentError) ? 'block' : 'none'; ?>;">
    <div class="popup-content" id="popup-content">
        <form action="index.php" method="post">
            <div>
                <h2>Invite Members</h2>
                <p class="tagline">Send invitation to join "<?= $group_name ?>" study group</p>
                <div class="close-button" id="close-button">
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
                <?php echo ($currentError) ? $error['email']['message'] : '' ?>
            </div>
            <div>
                <input type="submit" value="Invite Member" name="invite-btn">
            </div>
        </form>
    </div>
</div>
<?php
$scripts = array(
    '../../../assets/js/showcontent.js',
    '../../../assets/js/invite.js'
);
require_once '../../../layout/footer.php';
mysqli_close($conn);
?>