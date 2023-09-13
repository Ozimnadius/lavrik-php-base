<?php

function getApps() : array{
	$f = fopen('db/apps.txt', 'r');
	$str = fread($f, filesize('db/apps.txt'));
	$lines = explode("\n", $str);
	unset($lines[count($lines) - 1]);
	$apps = [];
	
	foreach($lines as $line){
		$apps[] = appStrToArr($line);
	}
	
	return $apps;
}

function appStrToArr(string $str) : array{
	//$str = rtrim($str);
	$parts = explode(';', $str);
	return ['dt' => $parts[0], 'name' => $parts[1], 'phone' => $parts[2]];
}

function addApp(string $name, string $phone) : bool{
	$dt = date("Y-d-m H:i:s");
	$app = "$dt;$name;$phone\n";
	$f = fopen('db/apps.txt', 'a');
	fwrite($f, $app);
	fclose($f);
	return true;
}