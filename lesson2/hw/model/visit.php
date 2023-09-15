<?php

declare(strict_types=1);

function addVisitLog(): bool
{
    $dt = date("H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $uri = $_SERVER["REQUEST_URI"];
    $referer = $_SERVER['HTTP_REFERER'] ?? '';

    $entry = "$dt;$ip;$uri;$referer\n";

    return !!file_put_contents("logs/" . date("Y-m-d") . ".txt", $entry, FILE_APPEND);
}

function getLogs(): array
{
    $files = scandir('logs');
    return array_filter($files, function ($f) {
        return is_file("logs/$f") && checkLogName($f);
    });
}

function getLog(string $file): array
{
    $link = "logs/$file";
    $f = fopen($link, 'r');
    $str = fread($f, filesize($link));
    $lines = explode("\n", $str);
    unset($lines[count($lines) - 1]);
    $apps = [];

    foreach ($lines as $line) {
        $apps[] = appStrToArr($line);
    }

    return $apps;
}

function isValidLog(string $uri): bool
{
    return !!preg_match('/^[aA-zZ0-9-_\/\?\.=&]*$/', $uri);
}

function appStrToArr(string $str): array
{
    $str = rtrim($str);
    $parts = explode(';', $str);
    return ['time' => $parts[0], 'ip' => $parts[1], 'uri' => $parts[2], 'ref' => $parts[3]];
}

function checkLogName(string $name): bool
{
    return !!preg_match('/.*\.txt$/', $name);
}

