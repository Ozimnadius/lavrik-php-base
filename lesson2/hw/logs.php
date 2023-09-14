<?php

declare(strict_types=1);

include_once('model/visit.php');

$logs = getLogs();
?>

<div class="logs">
    <h1>Logs:</h1>
    <div class="logs__list">
    <? foreach ($logs as $log): ?>
        <div class="log">
            <a href="log.php?file=<?= $log; ?>">
                <?= $log; ?>
            </a>
        </div>
    <? endforeach; ?>
    </div>
</div>
<hr>
<a href="index.php">Move to main page</a>
	