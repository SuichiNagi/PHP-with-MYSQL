<?php 

require('new-connection.php');
$result = $mysqli->query('SELECT *, DATE_FORMAT(created_at, "%r %M %d %Y") AS formatted_date FROM users ORDER BY created_at DESC') or die($mysqli->error); 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quotes for the today</title>
    </head>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        section{
            height: 600px;
            width: 800px;
            margin: 0 auto ;
            padding: 20px;
        }
            section{
                overflow: scroll;
            }
            h1{
                text-align: center;
                font-size: 40px;
                margin-bottom: 15px;
            }
            div{
                margin: 10px 0;
            }
                .quote-box{
                    border-bottom: 1px solid black;
                }
                h2{
                    margin: 15px 0;
                }
                p{
                    text-align: center;
                }
    </style>
    <body>
        <h1>Here are the awesome quotes!</h1>
        <section>
            <div>
            <?php while($output = $result->fetch_assoc()): ?>
                <div class="quote-box">
                    <h2>"<?= $output['quote']; ?>"</h2>
                    <p>-<?= $output['fname']; ?> at <?= $output['formatted_date'];  ?></p>
                </div>
                    <?php endwhile; ?>
            </div>
            <?php 
                function pre_r($array){
                    echo '<pre>';
                    print_r($array);
                    echo '</pre>';
                }
                ?>
        </section>
    </body>
</html>