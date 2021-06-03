<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body{
            font-family: sans-serif;
        }
            form{
                border: 2px solid;
                padding: 35px 15px 0;
                margin: 0 auto;
                height: 150px;
                width: 250px;
            }
                input{
                    margin: 15px 5px 0;
                }
                    input.email{
                        width: 230px;
                    }
                    input.button{
                        padding: 5px;
                    }
            p{
                color: red;
            }
    </style>
</head>
<body>
    <form action="process.php" method="POST">
        Please enter a valid email address: <input class="email" type="text" name="email" value="<?= @$_SESSION['email_value']; ?>">
        <input class="button" type="submit" name="submit" value="Submit">
        <?= "<p>".@$_SESSION['email_error']."</p>"; ?>
    </form>

    <?php
        unset($_SESSION['message']);
        unset($_SESSION['email_error']);
        unset($_SESSION['email_value']);
    ?>
</body>
</html>