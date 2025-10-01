<?php
session_start();
$username = $_SESSION["username"];
$stylesheets = array(
    'assets/stylesheets/homepage.css'
);
$title = "Home";
require_once('layout/header.php');

?>
<div class="navbar">
    <div class="logo">
        <h1 class="brand-name">EduVault</h1>
        <p class="brand-tag-line">Unlock your learning, all in one place</p>
    </div>

    <button onclick="location.href='assets/scripts/logout.php'" class="account"> Logout </button>
</div>
<div class="container">
    <div class="content-container">
        <div class="header-container">
            <h2 class="content-header">Welcome back, <?php echo $username ?>!</h2>
        </div>
        <div class="card-container">
            <a href="pages/study-groups/">
                <div class="card">
                    <img src="assets/icons/group.png" class="card-icon">
                    <p class="card-text">Study Groups</p>
                </div>
            </a>
        </div>

        <!-- <div class="recent-activity">
            <div class="recent-activity-header-container">
                <h2 class="recent-activity-header">Recent Activity</h2>
                <p class="recent-activity-tag-line">
                    Stay updated with your recent activities
                </p>
            </div>
            <div class="activities-container">
                <ul class="activities">
                    <li>Task 1</li>
                    <li>Task 1</li>
                    <li>Task 1</li>
                    <li>Task 1</li>
                </ul>
            </div>
        </div> -->

    </div>
</div>

<?php
require_once('layout/footer.php');
?>