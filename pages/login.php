<?php
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../components/textbox.css">
</head>

<body>
    <div class="parent">
        <div class="main-div">
            <h1 class="brand">EduVault</h1>
            <div class="login-form-container">
                <h2 class="login-text">Login</h2>
                <p class="login-tag">Enter your credentials to access your account.</p>
                <form action="login.php" method="post" class="login-form">
                    <?php
                    $label = "Email Address";
                    $type = "email";
                    include '../components/textfield.php';

                    $label = "Password";
                    $type = "password";
                    include '../components/textfield.php';
                    ?>
                    <input type="submit" value="Login" name="login" class="login-button">
                </form>
                <p>Don't have an account? <a href="signup.php">Create one here</a></p>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST["login"])) {
    header('Location: ../index.php');
}
?>