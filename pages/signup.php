<?php
if (isset($_POST["signup"])) {
    header('Location: homepage.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="../components/textbox.css">
</head>

<body>
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
                    include '../components/textfield.php';

                    $label = "Email Address";
                    $type = "email";
                    include '../components/textfield.php';

                    $label = "Password";
                    $type = "password";
                    include '../components/textfield.php';

                    $label = "Confirm Password";
                    $type = "password";
                    include '../components/textfield.php';
                    ?>
                    <input type="submit" name="signup" value="Create Account" class="signup-button">
                </form>
                <p>Already have an account? <a href="../index.php">Sign in here</a></p>
            </div>
        </div>
    </div>
</body>

</html>