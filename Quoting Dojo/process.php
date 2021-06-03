<?php

session_start();
require('new-connection.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $quotes = $_POST['quotes'];

    if($_POST['name'] == ''){
        $_SESSION['name_error'] = 'Please enter your name';
    }

    if($_POST['quotes'] == ''){
        $_SESSION['quotes_error'] = 'Please add some quotes';
    }

    if($_POST['name'] AND $_POST['quotes'] != ''){
        $mysqli->query("INSERT INTO users(fname, quote, created_at) VALUES('$name', '$quotes', NOW())") or die($mysqli->error);
        header('Location: main.php');
        exit;
    }
header('Location: index.php');
exit;
}

if(isset($_POST['skip'])){
    header('Location: main.php');
}
?>