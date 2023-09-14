<?php
declare(strict_types=1);

include_once('model/articles.php');
include_once('model/visit.php');

addEntry();

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