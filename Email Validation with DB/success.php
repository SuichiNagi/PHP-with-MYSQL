<?php 

session_start();

require('new-connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        div{
            border: 2px solid black;
            margin: 0 auto;
            text-align: center;
            padding: 15px;
            width: 550px;
            height: 50px;
        }
        div.failed{
            background: red;
        }
        div.success{
            background: rgb(106,168,78);
        }
        h1{
            text-align: center;
        }
        table{
            margin: 0 auto;
            width: 600px;
            padding: 15px;
        }
        td{
            text-align: center;
        }
            td h4{
                display: inline-block;
                margin-right: 20px;
            }
            .delete{
                background: crimson;
                color: white;
                padding: 5px;
                cursor: pointer;
                border: 1px solid black;
                text-decoration: none;
            }
    </style>
</head>
<body>
    <h2><?= $_SESSION['message']; ?></h2>
    <h1>Email Addresses Entered</h1>
    <table>
<?php
    $query = "SELECT id, email, created_at FROM users";
    $query_run = mysqli_query($connection, $query);

    
    while($row = mysqli_fetch_array($query_run))
    {
        ?>
        <tr>
            <td><h3><?= $row['email']; ?> </h3></td>
            <td><h4><?= $row['created_at']; ?></h4></td>
            <td><a href="delete.php?rn=$result[id]" class="delete">Delete</a></td><br>
        </tr>
        <?php
    }
?>
    </table>
</body>
</html>