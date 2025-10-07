<?php
$group_id = $_GET['id'];
$group_name = $_GET['name'];
require_once '../../../helper/auth.php'; // to login the user if they are not logged in
requireLogin();
$stylesheets = array(
    '../../../assets/css/group.css',
);
$title = $group_name;
require_once '../../../layout/header.php';
require_once '../../../controllers/fetch_group_info.php';
?>
<div class="parent">
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
                <p><?= $member_count ?> members</p>
            </div>
        </div>

        <div class="button-container">
            <button onclick="showContent('members', this)" class="button active-btn">Members</button>
            <button onclick="showContent('files', this) " class="button">Files</button>
        </div>

        <div class="content">
            <div id="members" class="contents active">
                <div class="members-header">
                    <h1>Group Members(8)</h1>
                    <button>Invite Members</button>
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
<script>
    function showContent(id, button) {
        //hide all content
        document.querySelectorAll('.contents').forEach(div => {
            div.classList.remove('active')
        })

        //have the selected div be active(visible)
        document.getElementById(id).classList.add('active');

        //remove active button styles from all buttons
        document.querySelectorAll('.button').forEach(btn => {
            btn.classList.remove('active-btn')
        })

        //make the clicked button have active button styling
        button.classList.add('active-btn')
    }
</script>
<?php
require_once '../../../layout/footer.php';
?>