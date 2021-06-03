<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wall</title>
</head>
    <link rel="stylesheet" href="index.css">
<body>
<?php
        if(isset($_SESSION['errors']))
        {
            foreach($_SESSION['errors'] as $error)
            {
                echo "<p class='error'>{$error}</p>";
            }
            unset($_SESSION['errors']);
        }
        if(isset($_SESSION['success_message'])){
            echo "<p class='success'>{$_SESSION['success_message']}</p>";
            unset($_SESSION['success_message']);
        }


?>
    <section>
        <h2>Register</h2>
        <form action="process.php" method="POST">
            <input type="hidden" name="action" value="register">
            <label for="fname">First name:</label><input type="text" name="fname"><br>
            <label for="lname">Last name:</label><input type="text" name="lname"><br>
            <label for="email">Email address:</label><input type="text" name="email"><br>
            <label for="password">Password:</label><input type="password" name="password"><br>
            <label for="confirm_password"> Confirm password:</label><input type="password" name="confirm_password"><br>
            <input class="btn-register" type="submit" value="Register">
        </form>
        <h2>Login</h2>
        <form action="process.php" method="POST">
            <input type="hidden" name="action" value="login">
            <label for="email">Email address:</label><input type="text" name="email"><br>
            <label for="password">Password:</label><input type="password" name="password"><br>
            <input class="btn-login" type="submit" value="Login">
        </form>
    </section>
</body>
</html>