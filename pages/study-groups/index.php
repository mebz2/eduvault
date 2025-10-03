<?php
$stylesheets = array(
    '../../assets/css/study-groups.css',
    '../../assets/css/popup.css',
    '../../assets/css/textbox.css',
    '../../assets/css/errorbox.css'
);
$title = "Study Groups";
require_once '../../layout/header.php';
?>

<div class="parent" id="parent">
    <div class="navbar">
        <div class="logo">
            <a href="../homepage.php" class="back">
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
    <?php
    echo $group_name;
    echo $group_description;
    ?>
</div>
<div class="popup" id="popup">
    <div class="popup-content" id="popup-content">
        <form action="index.php" method="post" class="create-group">
            <div>
                <h2>Create Study Group</h2>
                <p class="tagline">Start a new study group and invite others to join</p>
                <div class="close-button" id="close-button">
                    <img src="../../assets/icons/close.png" alt="" class="close-image">
                </div>
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
                <input type="submit" value="Create Group" name="create-button">
            </div>
        </form>
    </div>
</div>

<?php
$scripts = array(
    '../../assets/js/create_group.js',
);
require_once '../../layout/footer.php';
$error = [];
require_once '../../controllers/create_group.php';
if (!empty($error)) {
    require_once '../../components/errorbox.php';
}

?>