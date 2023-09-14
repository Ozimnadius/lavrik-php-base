<?php

	include_once('model/articles.php');
	include_once('model/visits.php');
	
	addVisitLog();	
	$articles = getArticles();

	$strId = $_GET['id'] ?? '';
	$id = (int)$strId;
	$normId = ($strId === (string)$id);
	// preg_match(/^[1-9]+[0-9]*$/)
	
	$post = $articles[$id] ?? null;
	$hasPost = $normId && ($post !== null);

?>
<div class="content">
	<? if($hasPost): ?>
		<div class="article">
			<h1><?=$post['title']?></h1>
			<div><?=$post['content']?></div>
			<hr>
			<a href="delete.php?id=<?=$id?>">Remove</a> | 
			<a href="edit.php?id=<?=$id?>">Edit</a>
		</div>
	<? else: ?>
		<div class="e404">
			<h1>Страница не найдена!</h1>
		</div>
	<? endif; ?>
</div>
<hr>
<a href="index.php">Move to main page</a>