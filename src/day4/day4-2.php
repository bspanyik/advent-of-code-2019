<?php

declare(strict_types=1);

$possible = 0;
for ($i = 278384; $i <= 824795; $i++) {
    $digits = str_split((string) $i);

    if (in_array('0', $digits) || in_array('1', $digits)) {
        continue;
    }

    $same = ['3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0];
    $is_lower = true;
    for ($j = 0; $j < 5; $j++) {
        if ($digits[$j] > $digits[$j + 1]) {
            $is_lower = false;
            break;
        } elseif ($digits[$j] === $digits[$j + 1]) {
            $same[$digits[$j]] += 1;
        }
    }
    if ($is_lower && in_array(1, $same)) {
        $possible += 1;
    }
}

echo $possible . PHP_EOL;
