<?php

declare(strict_types=1);

$possible = 0;
for ($i = 278384; $i <= 824795; $i++) {
    $digits = str_split((string) $i);

    if (in_array('0', $digits) || in_array('1', $digits)) {
        continue;
    }

    $is_same = false;
    $is_lower = true;
    for ($j = 4; $j >= 0; $j--) {
        if ($digits[$j] > $digits[$j + 1]) {
            $is_lower = false;
            break;
        } elseif ($digits[$j] === $digits[$j + 1]) {
            $is_same = true;
        }
    }
    if ($is_lower && $is_same) {
        $possible += 1;
    }
}

echo $possible . PHP_EOL;
