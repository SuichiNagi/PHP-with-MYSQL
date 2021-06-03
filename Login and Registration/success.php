<?php

    session_start();
    echo "Hello, {$_SESSION['first_name']}!";
    echo "<a href='process.php'>LOG OFF!</a>"

?>