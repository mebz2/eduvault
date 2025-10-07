<?php
$stylesheets = array(
    '../../../assets/css/group.css',
);
$title = "Group";
require_once '../../../layout/header.php';
require_once '../../../helper/auth.php'; // to login the user if they are not logged in
requireLogin();
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
                <p class="brand-name">Group</p>
                <p class="brand-tag-line">Description for the group</p>
            </div>
        </div>
    </div>

    <div class="main-div">
        <div class="group-info">
            <p class="group-description">This is the group description</p>
            <div>
                <img src="../../../assets/icons/user-avatar.png" class="member-image">
                <p>8 members</p>
            </div>
        </div>

        <div class="button-container">
            <button onclick="showContent('files')" class="button">Files</button>
            <button onclick="showContent('members') " class="button">Members</button>
        </div>

        <div class="content">
            <div id="files" class="contents active">
                <h1>Hello</h1>
            </div>
            <div id="members" class="contents">
                <h1>Bye</h1>
            </div>
        </div>
    </div>
</div>
<script>
    function showContent(id) {
        document.querySelectorAll('.contents').forEach(div => {
            div.classList.remove('active')
        })
        document.getElementById(id).classList.add('active');
    }
</script>
<?php
require_once '../../../layout/footer.php';
?>