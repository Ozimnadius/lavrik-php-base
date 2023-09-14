<?php

declare(strict_types=1);

include_once('model/articles.php');
include_once('model/visit.php');

addEntry();
$articles = getArticles();

?>
<a href="add.php">Add article</a>
<hr>
<div class="articles">
    <? foreach ($articles as $id => $article): ?>
        <div class="article">
            <h2><?= $article['title'] ?></h2>
            <a href="article.php?id=<?= $id ?>">Read more</a>
        </div>
    <? endforeach; ?>
</div>
<hr>
<a href="logs.php">Go to logs</a>
	