<?php

	include_once('model/articles.php');		
	include_once('model/visits.php');
	
	addVisitLog();
	$id = (int)($_GET['id'] ?? '');

	$res = removeArticle($id);
	/*
		your code here
		get id from url
		check id
		call removeArticle
	*/
?>
<h2><?=($res ? 'Article was removed!' : 'Article not found!')?></h2>
<hr>
<a href="index.php">Move to main page</a>