<?php 

session_start();
require('connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'register')
{
    //call to function
    register_user($_POST); //actual POST
}

elseif(isset($_POST['action']) && $_POST['action'] == 'login')
{
    login_user($_POST); //actual POST
}
else
{
    session_destroy();
    header('location: index.php');
    die();
}

function register_user($post) //a parameter called post
{
    //--------------Begin Validation Check-------------------//
    $_SESSION['errors'] = array();

    if(empty($post['first_name']))
    {
        $_SESSION['errors'][] = "first name can't be blank!";
    }
    if(strlen($post['first_name']) < 2)
    {
        $_SESSION['errors'][] = "first name must be 2 character long each!";
    }
    if(empty($post['last_name']))
    {
        $_SESSION['errors'][] = "last name can't be blank!";
    }
    if(strlen($post['last_name']) < 2)
    {
        $_SESSION['errors'][] = "last name must be 2 character long each!";
    }
    if(!preg_match("/^[a-zA-Z -]*$/", $post['first_name'])){
        $_SESSION['errors'][] = "no special character in first name";
    }
    if(!preg_match("/^[a-zA-Z -]*$/", $post['last_name'])){
        $_SESSION['errors'][] = "no special character in last name";
    }
    if(strlen($post['password']) <= 8)
    {
        $_SESSION['errors'][] = "minimum length of password is 8!";
    }
    if(empty($post['password']))
    {
        $_SESSION['errors'][] = "password field is required!";
    }
    if($post['password'] !== $post['confirm_password'])
    {
        $_SESSION['errors'][] = "password must match!";
    }
    if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['errors'][] = "please use a valid email address!";
    }
    //------------------End of Validation Check-----------------//

    if(count($_SESSION['errors']) > 0) // If I have any errors at all!
    {
        header('location: index.php');
        die();
    } 
    else //insert the data into the database
    {
    $password = md5($_POST['password']);
    $email = escape_this_string($_POST['email']);
        $query = "INSERT INTO users(first_name, last_name, password, email, created_at, updated_at)
                    VALUES('{$post['first_name']}','{$post['last_name']}','$password','$email',
                    NOW(), NOW())";
        run_mysql_query($query); 
        $_SESSION['success_message'] = 'User successfully created!';
        header('location: index.php');
        die();
    }

}

function login_user($post) //a parameter called post
{
    $password = md5($_POST['password']);
    $email = escape_this_string($_POST['email']);
    $query = "SELECT * FROM users WHERE password = '$password' AND email = '$email'";
    $user = fetch_all($query);
    if(count($user) > 0)
    {
        $_SESSION['user_id'] = $user[0]['id'];
        $_SESSION['first_name'] = $user[0]['first_name'];
        $_SESSION['logged_in'] = TRUE;
        header('location: success.php');
    }
    else
    {
        $_SESSION['errors'][] = "can't find user with those credentials";
        header('location: index.php');
        die();
    }
}

?>