<?php

	include_once('model/articles.php');
	include_once('model/visits.php');
	
	addVisitLog();
	$articles = getArticles();
	$strId = $_GET['id'] ?? '';
	$id = (int)$strId;
	$isNormId = ($strId === (string)$id);
	$post = $articles[$id] ?? null;
	$hasPost = $isNormId && ($post !== null);

	if(!$hasPost){
		exit('Error!');
	}

	$isSend = false;
	$err = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		
		if($title === '' || $content === ''){
			$err = 'Заполните все поля!';
		}
		else{
			editArticle($id, $title, $content);
			$isSend = true;
		}
	}
	else{
		$title = $post['title'];
		$content = $post['content'];
	}

?>
<div class="form">
	<? if($isSend): ?>
		<p>Your article is done!</p>
	<? else: ?>
		<form method="post">
			Name:<br>
			<input type="text" name="title" value="<?=$title?>">
			<br>
			Phone:<br>
			<textarea name="content"><?=$content?></textarea>
			<br>
			<button>Send</button>
			<p><?=$err?></p>
		</form>
	<? endif; ?>
</div>
<hr>
<a href="index.php">Move to main page</a>