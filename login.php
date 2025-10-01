<?php
$stylesheets = array(
    'assets/stylesheets/login.css',
    'assets/stylesheets/errorbox.css',
    'assets/stylesheets/textbox.css'
);
$title = "Login";
require_once('layout/header.php');
require_once('database.php');
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
$error = [];
if (isset($_POST["login"])) {
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $pass = $_POST["password"];

    if (empty($email) || empty($pass)) {
        array_push($error, "All fields are required!");
        goto display_error;
    }

    $find_user = "SELECT * FROM users WHERE email = '{$email}'";
    $user_result = mysqli_query($conn, $find_user);
    if (mysqli_num_rows($user_result) > 0) {
        $user = mysqli_fetch_assoc($user_result);

        $username = $user['username'];
        $user_id = $user['id'];
        $hash_password = $user['password'];

        if (!password_verify($pass, $hash_password)) {
            array_push($error, "Your password is incorrect please try again!");
            goto display_error;
        }
    } else {
        array_push($error, "A user with this email does not exist!");
        goto display_error;
    }

    if (empty($error)) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        mysqli_close($conn);
        header("Location: homepage.php");
        exit();
    } else {
        display_error:
        echo "
    <div class='error-box'>
        <h3>Login Errors</h3>
    <ul>";
        foreach ($error as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
}
mysqli_close($conn);
?>