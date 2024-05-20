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
    $planets[$orbiter][] = $base;
}

$bestPath = [];
findPath('YOU', 'SAN');

// -1 YOU, -1 because nr of jumps between planets needed
echo count($bestPath) - 2 . PHP_EOL;

/**
 * @param string $start
 * @param string $end
 * @param string[] $path
 */
function findPath(string $start, string $end, array $path = []): void
{
    global $planets, $bestPath;

    $path[] = $start;

    foreach ($planets[$start] as $step) {
        if ($step === $end) {
            if ($bestPath === [] || count($bestPath) > count($path)) {
                $bestPath = $path;
            }
            return;
        }

        if (in_array($step, $path)) {
            continue;
        }

        findPath($step, $end, $path);
    }
}
