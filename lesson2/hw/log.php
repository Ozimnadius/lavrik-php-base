<?php
declare(strict_types=1);

include_once('model/visit.php');

$file = ($_GET['file'] ?? '');
if (!empty($file)):
    $log = getLog($file);
    ?>
    <style>
        table{
            border-collapse: collapse;
        }

        td{
            padding: 10px;
            border: 1px solid black;
        }
    </style>
    <div class="log">
        <h1><?= $file ?></h1>
        <table>
            <thead>
            <th>Time</th>
            <th>Ip</th>
            <th>Uri</th>
            <th>Referer</th>
            </thead>
            <tbody>
            <? foreach ($log as $i): ?>
                <tr <? if (!isValidLog($i['uri'])): ?>style="color:red;" <? endif; ?>>
                    <td><?= $i['time']; ?></td>
                    <td><?= $i['ip']; ?></td>
                    <td><?= $i['uri']; ?></td>
                    <td><?= $i['ref']; ?></td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>
<? endif; ?>
<hr>
<a href="logs.php">Back</a>