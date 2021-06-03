<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dojo Quotes</title>
    <style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
        section{
            margin: 20px auto 0;
            border: 1px solid black;
            width: 700px;
            height: 650px;
            padding: 15px;
        }
            section h1{
                text-align: center;
                font-size: 35px;
                margin: 55px 0;
            }
                section form p{
                    font-size: 25px;
                    display: inline;
                    vertical-align: top;
                    margin: 15px 0;
                }
                textarea{
                    border: 2px solid black;
                }
                .txtname{
                    border: 2px solid black;
                    height: 30px;
                    width: 200px;
                    margin-bottom: 10px;
                }
                .button{
                    cursor: pointer;
                    margin-top: 5px;
                    margin-left: 190px;
                    padding: 5px;
                    box-shadow: 3px 3px black;
                    border: 2px solid black;
                }
                .error{
                    text-align: center;
                    color: red;
                }
    </style>
</head>
<body>
    <section>
        <h1>Welcome to QoutingDojo</h1>
        <form action="process.php" method="post">
            <p>Your Name:</p> <input class="txtname" type="text" name="name"><br>
            <h5 class="error"><?= @$_SESSION['name_error'];?></h5></br>
            <p>Your Quote:</p> <textarea rows="20" cols="70" name="quotes"></textarea><br>
            <h5 class="error"><?= @$_SESSION['quotes_error'];?></h5></br>
            <input class="button" type="submit" name="submit" value="Add my quote!">
            <input class="button"  type="submit" name="skip" value="Skip to quotes!"></br>
        </form>
    </section>
            <?php
                unset($_SESSION['name_error']);
                unset($_SESSION['quotes_error']);
            ?>
</body>
</html>