<?php

include_once('functions.php');

$articles = getArticles();
$id = (int)($_GET['id'] ?? '');
$post = $articles[$id] ?? null;
$hasPost = ($post !== null);

$isEdited = false;
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if($title === '' || $content === ''){
        $err = 'Заполните все поля!';
    } else {
        $isEdited = editArticle($id,$title, $content);
        $articles = getArticles();
        $post = $articles[$id] ?? null;
        $hasPost = ($post !== null);
    }

};


?>

<div class="content">
    <? if ($hasPost): ?>
        <form method="post">
            <h1>Edit article</h1>
            Title:<br>
            <input type="text" name="title" value="<?= $post['title'] ?>"><br>
            Content:<br>
            <textarea name="content"
                      id=""
                      cols="30"
                      rows="10"><?= $post['content'] ?></textarea><br>
            <p><?=$err?></p>
            <button>Send</button>
        </form>

        <? if ($isEdited): ?>
            <h2>Article edited!</h2>
        <? endif; ?>
    <? else: ?>
        <div class="e404">
            <h1>Error!</h1>
        </div>
    <? endif; ?>

</div>
<hr>
<a href="index.php">Move to main page</a>