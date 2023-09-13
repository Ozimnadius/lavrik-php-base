<?php

include_once('model/apps.php');

$isSend = false;
$err = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$name = trim($_POST['name']);
	$phone = trim($_POST['phone']);
	
	if($name === '' || $phone === ''){
		$err = 'Заполните все поля!';
	}
	else if(mb_strlen($name, 'UTF8') < 2){
		$err = 'Имя не короче 2 символов!';
	}
	else{
		addApp($name, $phone);
		$isSend = true;
	}
}
else{
	$name = '';
	$phone = '';
}

?>
<div class="form">
	<? if($isSend): ?>
		<p>Your app is done!</p>
	<? else: ?>
		<form method="post">
			Name:<br>
			<input type="text" name="name" value="<?=$name?>"><br>
			Phone:<br>
			<input type="text" name="phone" value="<?=$phone?>"><br>
			<button>Send</button>
			<p><?=$err?></p>
		</form>
	<? endif; ?>
</div>