<?php 

session_start();

require('new-connection.php');
$_SESSION['errors'] = array();

if(isset($_POST['action']) && $_POST['action'] == 'create_message'){
    $mysqli->query("INSERT INTO messages(user_id, message, created_at, updated_at) 
        VALUES ('{$_SESSION['user_id']}', '{$_POST['message']}', NOW(), NOW())") or die ($mysqli->error);
    header('location: main.php');
}
elseif(isset($_POST['action']) && $_POST['action'] == 'create_comment'){
    $mysqli->query("INSERT INTO comments(message_id, user_id, comment, created_at, updated_at) 
        VALUES ('{$_POST['message_id']}', '{$_SESSION['user_id']}', '{$_POST['comment']}', NOW(), NOW())") or die ($mysqli->error);
    header('location: main.php');
}
if(isset($_POST['action']) && $_POST['action'] == 'register'){

    if(empty($_POST['fname'])){
        $_SESSION['errors'][] = "first name can't be blank!";
    }
    if(empty($_POST['lname'])){
        $_SESSION['errors'][] = "last name can't be blank!";
    }
    if(!preg_match("/^[a-zA-Z -]*$/", $_POST['fname'])){
        $_SESSION['errors'][] = "don't use number or special character in first name!";
    }
    if(!preg_match("/^[a-zA-Z -]*$/", $_POST['lname'])){
        $_SESSION['errors'][] = "don't use number or special character in first name!";
    }
    if(empty($_POST['email'])){
        $_SESSION['errors'][] = "email can't be blank!";
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['errors'][] = "please use a valid email address!";
    }
    if(empty($_POST['password']))
    {
        $_SESSION['errors'][] = "password field is required!";
    }
    if(strlen($_POST['password']) <= 8)
    {
        $_SESSION['errors'][] = "minimum length of password is 8!";
    }
    if($_POST['password'] !== $_POST['confirm_password'])
    {
        $_SESSION['errors'][] = "password must match!";
    }

    if(count($_SESSION['errors']) > 0) // If I have any errors at all!
    {
        header('location: index.php');
        die();
    } 
    else //insert the data into the database
    {
    $encrypted_password = md5($_POST['password']);
        $mysqli->query("INSERT INTO users(first_name, last_name, email, password, created_at, updated_at)
                    VALUES('{$_POST['fname']}','{$_POST['lname']}','{$_POST['email']}','{$encrypted_password}', NOW(), NOW())") or die ($mysqli->error);
        $_SESSION['success_message'] = 'User successfully created!';
        header('location: index.php');
        die();
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'login'){
    if(empty($_POST['email'])){
        $_SESSION['errors'][] = 'email required!';
    }
    if(empty($_POST['password'])){
        $_SESSION['errors'][] = 'password required!';
    }
    header('location: index.php');


    if (!empty($_POST['email']) and !empty($_POST['password'])) {
        $encrypted_password = md5($_POST['password']);
        $query = "SELECT * FROM users WHERE users.email = '{$_POST['email']}' AND users.password = '{$encrypted_password}'";
        $result = $mysqli->query($query);
        $user = $result->fetch_assoc(MYSQLI_ASSOC);
        if (count($user) > 0) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['logged_in'] = TRUE;
            header('location: main.php');
        } else {
            $_SESSION['errors'][] ="Wrong email or invalid password";
            header('location: index.php');
        }
    }
}

?>