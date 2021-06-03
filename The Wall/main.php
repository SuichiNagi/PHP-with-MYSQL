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
    <title>Document</title>
</head>
<body>
    <div><h1>Coding Dojo</h1>
    <?php echo "{$_SESSION['first_name']}"; ?><br>
    <?php echo "<a href='index.php'>LOG OFF!</a>" ?>
    </div>

    <h1>This is my wall!</h1>
    <h2>Post a message</h2>
    <form action="process.php" method="POST">
        <input type="hidden" name="action" value="create_message">
        <textarea name="message" placeholder="Post a message"></textarea>
        <input type="submit" value="Create a message">
    </form>

    <?php 
    
    $query = "SELECT messages.*, users.first_name, users.last_name 
                FROM messages 
                LEFT JOIN users ON users.id = messages.user_id ORDER BY id DESC";
    $result = $mysqli->query($query);
    $messages = $result->fetch_all(MYSQLI_ASSOC);
    var_dump($messages);
    ?>

    <?php

    foreach($messages as $message)
    { ?>
    <h2>Message from <?= $message['first_name'] ?> <?= $message['last_name'] ?> (<?= $message['created_at'] ?>)</h2>
    <p><?= $message['message'] ?></p>
    
    <?php
    $query = "SELECT comments.*, users.first_name, users.last_name 
                FROM comments 
                LEFT JOIN users ON users.id = comments.user_id 
                WHERE comments.message_id = {$message['id']}";
    $result = $mysqli->query($query);
    $comments = $result->fetch_all(MYSQLI_ASSOC);
    var_dump($comments);
    ?>
    <?php
        foreach($comments as $comment)
        {
    ?> 
    <h3>Comment from <?= $comment['first_name'] ?> <?= $comment['last_name'] ?> (<?= $comment['created_at'] ?>)</h3>
    <p><?= $comment['comment'] ?></p>
    <?php    
        }
    ?>
    <h3>Post a comment</h3>
    <form action="process.php" method="POST">
        <input type="hidden" name="action" value="create_comment">
        <input type="hidden" name="message_id" value="<?php $message['id'] ?>">
        <textarea name="comment" placeholder="Post a comment"></textarea>
        <input type="submit" value="Create a comment">
    </form>
    <?php
    }
    ?>
</body>
</html>