<?php

declare(strict_types=1);

$input = file($argv[1] ?? 'input.txt', FILE_IGNORE_NEW_LINES);
if ($input === false) {
    die('There\'s something wrong with the input file. I don\'t know what it is.' . PHP_EOL);
}

$grid = [];
foreach ($input as $key => $wirePath) {
    $x = 0;
    $y = 0;
    $grid[$key] = [];

    foreach (explode(',', $wirePath) as $step) {
        $dir = $step[0];
        $length = ltrim($step, 'URDL');
        if ($dir === 'U') {
            for ($i = 1; $i <= $length; $i++) {
                $grid[$key][] = $x . ' ' . ($y - $i);
            }
            $y -= $length;
        }
        if ($dir === 'D') {
            for ($i = 1; $i <= $length; $i++) {
                $grid[$key][] = $x . ' ' . ($y + $i);
            }
            $y += $length;
        }
        if ($dir === 'L') {
            for ($i = 1; $i <= $length; $i++) {
                $grid[$key][] = ($x - $i) . ' ' . $y;
            }
            $x -= $length;
        }
        if ($dir === 'R') {
            for ($i = 1; $i <= $length; $i++) {
                $grid[$key][] = ($x + $i) . ' ' . $y;
            }
            $x += $length;
        }
    }
}

$minimal = null;
foreach (array_intersect($grid[0], $grid[1]) as $intersect) {
    $sum = array_search($intersect, $grid[0]) + array_search($intersect, $grid[1]) + 2;
    if (!isset($minimal) || $sum < $minimal) {
        $minimal = $sum;
    }
}

echo $minimal . PHP_EOL;
