<?php 

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DATABASE', 'login_registration');

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

if($connection->connect_errno)
{
    die("Failed to connect to MySQL: (" . $connection->connect_errno . ")" . $connection->connect_error);
}

//use when expecting multiple results
function fetch_all($query)
{
    $data = array();
    global $connection;
    $result = $connection->query($query);

    while($row = mysqli_fetch_assoc($result)); 
    {
        $data[] = $row;
    }
    return $data;
}

//use when expecting a single result
function fetch_record($query)
{
    global $connection;
    $result = $connection->query($query);
    return mysql_fetch_assoc($result);
}

//use to run INSERT/DELETE/UPDATE, queries that don't return a value
function run_mysql_query($query)
{
    global $connection;
    $result = $connection->query($query);
    return $connection->insert_id;
}

function escape_this_string($string)
{
    global $connection;
    return $connection->real_escape_string($string);
}

?>