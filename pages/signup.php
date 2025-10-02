<?php
$stylesheets = array(
    '../assets/css/signup.css',
    '../assets/css/textbox.css',
    '../assets/css/errorbox.css'
);
$title = "Sign Up";
require_once('../layout/header.php');
?>
<div class="parent">
    <div class="main-div">
        <h1 class="brand">EduVault</h1>
        <div class="signup-form-container">
            <h2 class="signup-text">Create Account</h2>
            <p class="signup-tag">Enter your details to get started with EduVault.</p>
            <form action="signup.php" method="post" class="signup-form">
                <?php
                $label = "Username";
                $type = "text";
                $name = "username";
                include '../components/textfield.php';

                $label = "Email Address";
                $type = "email";
                $name = "email";
                include '../components/textfield.php';

                $label = "Password";
                $type = "password";
                $name = "password";
                include '../components/textfield.php';

                $label = "Confirm Password";
                $type = "password";
                $name = "cpassword";
                include '../components/textfield.php';
                ?>
                <input type="submit" name="signup" value="Create Account" class="signup-button">
            </form>
            <p>Already have an account? <a href="login.php">Sign in here</a></p>
        </div>
    </div>
</div>

<?php
require_once('../layout/footer.php');
require_once '../controllers/signup_script.php';

?>