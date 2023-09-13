<?php

$f = fopen('some.txt', 'r');

while(!feof($f)){
	$l = fread($f, 1);
	echo "<li>$l</li>";
}

fclose($f);