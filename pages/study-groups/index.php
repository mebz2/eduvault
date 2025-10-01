<?php
$stylesheets = array(
    '../../assets/stylesheets/study-groups.css',
    '../../assets/stylesheets/popup.css',
    '../../assets/stylesheets/textbox.css'
);
$title = "Study Groups";
require_once('../../layout/header.php');
?>
<div class="parent">
    <div class="navbar">
        <div class="logo">
            <a href="../../homepage.php" class="back">
                <div>
                    <img src="../../assets/icons/left-arrow.png" />
                </div>
            </a>
            <div>
                <p class="brand-name">Study Groups</p>
                <p class="brand-tag-line">Connect with peers, and study together</p>
            </div>
        </div>
        <button class="create-group-button" id="create-group-button">Create Group</button>
    </div>
    <div class="popup" id="popup">
        <div class="popup-content" id="popup-content">
            <form action="index.php" method="post" class="create-group">
                <div>
                    <h2>Create Study Group</h2>
                    <p class="tagline">Start a new study group and invite others to join</p>
                </div>
                <div>
                    <?php
                    $label = "Group Name";
                    $type = "text";
                    $name = "group-name";
                    include '../../components/textfield.php';
                    ?>
                </div>
                <div>
                    <label name="group-description">Group Description</label>
                    <textarea name="group-description" class="group-description" id="" rows="5"></textarea>
                </div>
                <div>
                    <input type="submit" value="Create Group" name="create-group-butt">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$scripts = array(
    '../../assets/scripts/create_group.js'
);
require_once('../../layout/footer.php');
?>