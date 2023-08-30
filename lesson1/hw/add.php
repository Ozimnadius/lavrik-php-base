<?php

include_once('functions.php');

$isAdded = false;
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if($title === '' || $content === ''){
        $err = 'Заполните все поля!';
    } else {
        $isAdded = addArticle($title, $content);
    }

};
?>
<? if ($isAdded): ?>
    <p>Post added!</p>
<? else: ?>
    <form method="post">
        Title:<br>
        <input type="text" name="title"><br>
        Content:<br>
        <textarea name="content" id="" cols="30" rows="10"></textarea><br>
        <button>Send</button>
        <p><?=$err?></p>
    </form>
<? endif; ?>
<hr>
<a href="index.php">Move to main page</a>