<?php
require_once 'helper/auth.php';
// if the user is already logged in redirect to homepage else redirect to the login page
if (isLoggedIn()) {
    header("Location: pages/homepage.php");
    exit();
} else {
    header("Location: pages/login.php");
    exit();
}
