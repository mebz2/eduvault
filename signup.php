<?php
$stylesheets = array(
    'assets/stylesheets/signup.css',
    'assets/stylesheets/textbox.css',
    'assets/stylesheets/errorbox.css',
);
require_once('layout/header.php');
require_once('database.php');
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
                include 'components/textfield.php';

                $label = "Email Address";
                $type = "email";
                $name = "email";
                include 'components/textfield.php';

                $label = "Password";
                $type = "password";
                $name = "password";
                include 'components/textfield.php';

                $label = "Confirm Password";
                $type = "password";
                $name = "cpassword";
                include 'components/textfield.php';
                ?>
                <input type="submit" name="signup" value="Create Account" class="signup-button">
            </form>
            <p>Already have an account? <a href="login.php">Sign in here</a></p>
        </div>
    </div>
</div>

<?php
require_once('layout/footer.php');
include 'assets/scripts/generateId.php';
$errors = [];

if (isset($_POST["signup"])) {
    $usern = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];

    // check if all the text boxes are filled
    if (empty($usern) || empty($email) || empty($pass) || empty($cpass)) {
        array_push($errors, "All fields are required!");
    }

    //check if the length of the password 
    if (strlen($pass) < 8) {
        array_push($errors, "Password must be atleast 8 characters long!");
    }

    // check if passwords match
    if (strcmp($pass, $cpass)) {
        array_push($errors, "Password and Confirmation password do not match!");
    }

    //check length of username
    if (strlen($usern) > 20) {
        array_push($errors, "Username is too long, maximum is 20 characters!");
    }

    //check if email is already in the database
    $email_query = "SELECT * FROM users WHERE email = '{$email}'";
    $email_result = mysqli_query($conn, $email_query);
    if (mysqli_num_rows($email_result) > 0) {
        array_push($errors, "A user with this email already exists, try again with another email address!");
    }

    // generate an id
    $attempts = 0;
    do {
        $id = generateID('U');
        $id_query = "SELECT * FROM users WHERE id = '{$id}'";
        $id_exists = mysqli_query($conn, $id_query);
        $attempts++;
    } while ($id_exists > 0 && $attempts < 5);

    if ($attempt >= 5) {
        array_push($errors, "Failed to generate random id");
    }

    if (empty($errors)) {
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (id, email, username, password) VALUES ('$id', '$email', '$usern', '$hashpass')";
        mysqli_query($conn, $sql);
        session_start();
        $_SESSION["username"] = $usern;
        header("Location: homepage.php");
    } else {
        echo "
    <div class='error-box'>
        <h3>Registration Errors</h3>
    <ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
}


mysqli_close($conn);
?>