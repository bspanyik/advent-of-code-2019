<?php

declare(strict_types=1);

$input = file($argv[1] ?? 'input.txt', FILE_IGNORE_NEW_LINES);
if ($input === false) {
    die('There\'s something wrong with the input file. I don\'t know what it is.' . PHP_EOL);
}

foreach ($input as $row) {
    [$base, $orbiter] = explode(')', $row);

    if (!isset($planets[$base])) {
        $planets[$base] = [];
    }
    $planets[$base][] = $orbiter;

    if (!isset($planets[$orbiter])) {
        $planets[$orbiter] = [];
    }
}

echo calcOrbits('COM') . PHP_EOL;

function calcOrbits(string $planet, int $level = 1, int &$orbits = 0): int
{
    global $planets;

    foreach ($planets[$planet] as $orbiter) {
        $orbits += $level;
        calcOrbits($orbiter, $level + 1, $orbits);
    }

    return $orbits;
}
