<?php

declare(strict_types=1);

$moduleMasses = file($argv[1] ?? 'input.txt', FILE_IGNORE_NEW_LINES);
if ($moduleMasses === false) {
    die('There\'s something wrong with the input file. I don\'t know what it is.' . PHP_EOL);
}

$moduleMasses = array_map('intval', $moduleMasses);

$totalFuelRequirement = 0;
foreach ($moduleMasses as $mass) {
    $totalFuelRequirement += floor($mass / 3) - 2;
}

echo $totalFuelRequirement . PHP_EOL;
