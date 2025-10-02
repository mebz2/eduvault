<?php
require_once 'helper/auth.php';
if (isLoggedIn()) {
    header("Location: pages/homepage.php");
    exit();
} else {
    header("Location: pages/login.php");
    exit();
}
