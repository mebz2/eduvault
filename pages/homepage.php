<?php
session_start();
$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="homepage.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <h1 class="brand-name">EduVault</h1>
            <p class="brand-tag-line">Unlock your learning, all in one place</p>
        </div>

        <button onclick="location.href='../index.php'" class="sign-in-button">Sign In</button>
        <button onclick="location.href='signup.php'" class="sign-up-button">Sign Up</button>
    </div>
    <div class="container">
        <div class="content-container">
            <div class="header-container">
                <h2 class="content-header">Welcome back, <?php echo $username; ?>!</h2>
            </div>
            <div class="card-container">
                <div class="card">
                    <img src="../assets/icons/group.png" class="card-icon">
                    <p class="card-text">Study Groups</p>
                </div>
            </div>

            <div class="recent-activity">
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
            </div>

        </div>
    </div>

    <script src=""></script>
</body>

</html>