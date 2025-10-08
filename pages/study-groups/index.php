<?php
//unset these global variables
session_start();
unset($_SESSION['group_id'], $_SESSION['group_name']);



require_once '../../controllers/fetch_groups.php';
include '../../controllers/create_group.php';
$stylesheets = array(
    '../../assets/css/study-groups.css',
    '../../assets/css/create-group-popup.css',
    '../../assets/css/textbox.css',
    '../../assets/css/errorbox.css'
);

$title = "Study Groups";
require_once '../../layout/header.php';
require_once '../../helper/auth.php'; // to login the user if they are not logged in
requireLogin();
?>



<!-- if there is an error keep the blur on the parent div since the popup won't go away -->
<div class="parent <?= ($currentError) ? 'blur' : '' ?>" id="parent">
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

    <div class="display-groups">
        <?php
        if (!isset($no_groups)) {
            foreach ($groups as $id => $group) {
                $group_id = $id;
                $group_name = $group['name'];
                $group_description = $group['description'];
        ?>
                <a href="group/index.php?id=<?= $group_id ?>&name=<?= urlencode($group_name) ?>" class="group-link">
                    <?php
                    include '../../components/group-card.php';
                    ?>
                </a>
        <?php
            }
        } else {
            echo "<h3> You are not part of any group!</h3>";
        }
        ?>
    </div>
</div>

<!-- div for popup which is hidden by default -->
<div class="popup" id="popup" style="display: <?php echo ($currentError) ? 'block' : 'none'; ?>">
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
                <!-- if there is an error display the error message -->
                <div class="error-text">
                    <?php echo ($currentError && $error[$currentError]['id'] == "group_name") ? $error[$currentError]['message'] : '' ?>
                </div>
            </div>
            <div>
                <label name="group-description">Group Description</label>
                <textarea name="group-description" class="group-description" id="" rows="5"></textarea>
                <!-- if there is an error display the error message -->
                <div class="error-text">
                    <?php echo ($currentError && $error[$currentError]['id'] == "group_description") ? $error[$currentError]['message'] : '' ?>
                </div>
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
?>