<?php

declare(strict_types=1);


function addEntry(): bool
{

    $dt = date("H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $uri = $_SERVER["REQUEST_URI"];
    $referer = $_SERVER['HTTP_REFERER'];

    $entry = "$dt;$ip;$uri;$referer\n";

    return !!file_put_contents("logs/".date("Y-d-m").".txt",$entry, FILE_APPEND);
}

function getLogs(): array
{
    $files = scandir('logs');
    $logs = array_filter($files, function($f){
        return is_file("logs/$f") && checkLogName($f);
    });
    return $logs;
}

function getLog(string $file): array
{
    $link = "logs/$file";
    $f = fopen($link, 'r');
    $str = fread($f, filesize($link));
    $lines = explode("\n", $str);
    unset($lines[count($lines) - 1]);
    $apps = [];

    foreach($lines as $line){
        $apps[] = appStrToArr($line);
    }

    return $apps;
}

function isValidLog(string $uri): bool
{
    $pattern = '/^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w.-]*)*\/?$/';
    return !preg_match($pattern, $uri);
}

function appStrToArr(string $str) : array{
    $str = rtrim($str);
    $parts = explode(';', $str);
    return ['time' => $parts[0], 'ip' => $parts[1], 'uri' => $parts[2], 'ref' => $parts[3]];
}

function checkLogName(string $name) : bool
{
    return !!preg_match('/.*\.txt$/', $name);
}

