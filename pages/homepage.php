<?php
session_start();
$username = $_SESSION["username"];
$stylesheets = array(
    '../assets/css/homepage.css'
);
$title = "Home";
require_once '../layout/header.php';

require_once '../helper/auth.php'; // to login the user if they are not logged in
requireLogin();
?>
<div class="navbar">
    <div class="logo">
        <h1 class="brand-name">EduVault</h1>
        <p class="brand-tag-line">Unlock your learning, all in one place</p>
    </div>

    <button onclick="location.href='../helper/logout.php'" class="account"> Logout </button>
</div>
<div class="container">
    <div class="content-container">
        <div class="header-container">
            <h2 class="content-header">Welcome back, <?php echo $username ?>!</h2>
        </div>
        <div class="card-container">
            <a href="study-groups/">
                <div class="card">
                    <img src="../assets/icons/group.png" class="card-icon">
                    <p class="card-text">Study Groups</p>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
require_once('../layout/footer.php');
?>