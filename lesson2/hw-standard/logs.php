<?php

include_once('model/visits.php');

$showDay = isset($_GET['dt']);

if($showDay){
	$name = $_GET['dt'] ?? '';
	$e404 = !hasVisitsDay($name);
	$visits = getVisits($name);
}
else{
	$visitsDays = getVisitsDays();
}

?>
<style>
	table, td{
		border: 1px solid #000;
	}

	td{
		padding: 10px;
	}

	.danger{
		color: red;
	}
</style>
<? if($showDay) : ?>
	<? if($e404): ?>
		<h1>Нет таких логов</h1>
	<? else: ?>
		<h1>Логи за <?=$name?></h1>
		<table>
			<tr>
				<th>Time</th>
				<th>Ip</th>
				<th>URI</th>
				<th>Referer</th>
			</tr>
			<? foreach($visits as $day): ?>
			<tr class="<?=$day['isDanger'] ? 'danger' : ''?>">
				<td><?=$day['dt']?></td>
				<td><?=$day['ip']?></td>
				<td><?=$day['uri']?></td>
				<td><?=$day['referer']?></td>
			</tr>
			<? endforeach; ?>
		</table>
	<? endif; ?>
<? else : ?>
	<div>
		<h1>Дни логов</h1>
		<ul>
			<? foreach($visitsDays as $day): ?>
			<li>
				<a href="logs.php?dt=<?=$day?>"><?=$day?></a>
			</li>
			<? endforeach; ?>
		</ul>
	</div>
<? endif; ?>