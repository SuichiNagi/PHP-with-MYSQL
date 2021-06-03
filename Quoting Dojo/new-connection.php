<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); 
define('DB_DATABASE', 'dojo-quotes'); 

$mysqli = new mysqli('localhost', 'root', '', 'dojo-quotes') or die(mysqli_error($mysqli));

?>