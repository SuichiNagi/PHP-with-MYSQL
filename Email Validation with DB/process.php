<?php

session_start();
require('new-connection.php');

$query = "INSERT INTO users (email, created_at)
VALUES('{$_POST['email']}', NOW())";

if(isset($_POST['submit']))
{
    if (empty($_POST["email"])) 
    {
        $_SESSION['email_error'] = "Email is required";
    }

    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
    {
        $_SESSION['email_error'] = "Invalid Email Format";
    }

    $_SESSION['email_value'] = $_POST['email'];

    if ($_POST['email'] !== '' AND
    filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
    {
        if(run_mysql_query($query))
        {
            $_SESSION['message'] = "<div class='success'>The email address you entered (".$_POST['email'].") is a VALID email address! Thank you!</div>";
        }
        else
        {
            $_SESSION['message'] = "<div class='failed'>Failed to add new email/ Email already added</div>"; 
        }
        header('Location: success.php');
        exit;
    }

    header('Location: index.php');
    exit;
}

var_dump(run_mysql_query($query));

?>