<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); 
define('DB_DATABASE', 'email-verification'); 

$connection = new mysqli("localhost", "root", "", "email-verification");

if($connection->connect_errno)
{
    die("Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error);
}

function run_mysql_query($query)
{
  global $connection;

  $result = mysqli_query($connection, $query);
  
  if(preg_match("/insert/i", $query))
  {
    return mysqli_insert_id($connection);
  }
  return $result; 
}
?>