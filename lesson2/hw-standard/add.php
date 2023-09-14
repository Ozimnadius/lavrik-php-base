<?php

	include_once('model/articles.php');
	include_once('model/visits.php');
	
	addVisitLog();

	$isSend = false;
	$err = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		
		if($title === '' || $content === ''){
			$err = 'Заполните все поля!';
		}
		else{
			addArticle($title, $content);
			$isSend = true;
		}
	}
	else{
		$title = '';
		$content = '';
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