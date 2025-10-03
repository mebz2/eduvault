<?php
$stylesheets = array(
    '../assets/css/login.css',
    '../assets/css/errorbox.css',
    '../assets/css/textbox.css'
);
$title = "Login";
require_once('../layout/header.php');
require_once '../controllers/login_script.php';

?>

<div class="parent">
    <div class="main-div">
        <h1 class="brand">EduVault</h1>
        <div class="login-form-container">
            <h2 class="login-text">Login</h2>
            <p class="login-tag">Enter your credentials to access your account.</p>
            <form action="login.php" method="post" class="login-form">
                <?php
                $label = "Email";
                $type = "email";
                $name = "email";
                $id = "email";
                include '../components/textfield.php';
                ?>
                <span id="email-error" class="error-text">
                    <?php echo ($currentError && $error[$currentError]['id'] == "email") ? $error[$currentError]['message'] : '' ?>
                </span>


                <?php
                $label = "Password";
                $type = "password";
                $name = "password";
                $id = "password";
                include '../components/textfield.php';
                ?>
                <span id="password-error" class="error-text">
                    <?php echo ($currentError && $error[$currentError]['id'] == "password") ? $error[$currentError]['message'] : '' ?>
                </span>
                <input type="submit" value="Login" name="login" class="login-button">
            </form>
            <p>Don't have an account? <a href="signup.php">Create one here</a></p>
        </div>
    </div>
</div>

<?php
require_once('../layout/footer.php');

?>