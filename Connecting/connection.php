<?php
/*--------------------BEGINNING OF THE CONNECTION PROCESS------------------*/
//define constants for db_host, db_user, db_pass, and db_database
//adjust the values below to match your database settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); //set DB_PASS as 'root' if you're using mac
define('DB_DATABASE', 'mysql'); //make sure to set your database
//connect to database host
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

if($connection->connect_errno)
{
    die("Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error);
}
/*-------------------------END OF CONNECTION PROCESS!---------------------*/
$users = $connection->query("SELECT * FROM user");
foreach($users as $user) {
    var_dump($user);
}
?>

