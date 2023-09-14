<?php
declare(strict_types=1);

include_once('model/articles.php');
include_once('model/visit.php');

addEntry();

$articles = getArticles();

$id = (int)($_GET['id'] ?? '');
$post = $articles[$id] ?? null;
$hasPost = ($post !== null);

?>
<div class="content">
    <? if ($hasPost): ?>
        <div class="article">
            <h1><?= $post['title'] ?></h1>
            <div><?= $post['content'] ?></div>
            <hr>
            <a href="delete.php?id=<?= $id ?>">Remove</a>
            <a href="edit.php?id=<?= $id ?>">Edit</a>
        </div>
    <? else: ?>
        <div class="e404">
            <h1>Страница не найдена!</h1>
        </div>
    <? endif; ?>
</div>
<hr>
<a href="index.php">Move to main page</a>