<?php

include_once('functions.php');

$isDeleted = false;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET["id"])) {
        $isDeleted = removeArticle((int)$_GET["id"]);
    }
}
?>
<? if ($isDeleted): ?>
    Article removed!
<? else: ?>
    Error!
<? endif; ?>
<hr>
<a href="index.php">Move to main page</a>