<?php
$stylesheets = array(
    'assets/stylesheets/login.css',
    'assets/stylesheets/textbox.css'
);
require_once('layout/header.php');
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
                include 'components/textfield.php';

                $label = "Password";
                $type = "password";
                $name = "password";
                $id = "password";
                include 'components/textfield.php';
                ?>
                <input type="submit" value="Login" name="login" class="login-button">
            </form>
            <p>Don't have an account? <a href="signup.php">Create one here</a></p>
        </div>
    </div>
</div>

<?php
require_once('layout/footer.php');
$errors = [];

if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        array_push($errors, "All fields are required!");
    }
}
?>