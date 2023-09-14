<?php

function checkVisitName(string $name) : bool{
	return !!preg_match('/^\d{4}\-\d{2}\-\d{2}\.txt$/', $name);
}

function hasVisitsDay(string $dt) : bool{
	return checkVisitName($dt) && file_exists("db/visits/$dt");
}

function getVisitsDays() : array{
	$files = scandir("db/visits");

	return array_filter($files, function($file){
		return is_file("db/visits/$file") && checkVisitName($file);
	});
}

function isValidUrl(string $url) : bool{
	return !!preg_match('/^[aA-zZ0-9-_\/\?\.=&]*$/', $url);
}

function getVisits(string $dt) : array{
	$lines = file("db/visits/$dt");

	return array_map(function($line){
		$log = json_decode(rtrim($line), true);
		$log['isDanger'] = !isValidUrl($log['uri']);
		return $log;
	}, $lines);
}

function addVisitLog() : bool{
	$logName = date("Y-m-d");

	$info = [
		'dt' => date("H:i:s"),
		'ip' => $_SERVER['REMOTE_ADDR'],
		'uri' => $_SERVER['REQUEST_URI'],
		'referer' => $_SERVER['HTTP_REFERER'] ?? ''
	];
	
	$log = json_encode($info) . "\n";
	file_put_contents("db/visits/$logName.txt", $log, FILE_APPEND);
	return true;
}

/*
	return array_map(function($line){
		return strlen($line);
	}, $lines);

	$res = [];

	foreach($lines as $line){
		$res[] = strlen($line);
	}

	return $res;
*/