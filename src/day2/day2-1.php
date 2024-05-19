<?php

declare(strict_types=1);

$input = file_get_contents($argv[1] ?? 'input.txt');
if ($input === false) {
    die('There\'s something wrong with the input file. I don\'t know what it is.' . PHP_EOL);
}

$memory = array_map('intval', explode(',', $input));

// 1202 override
echo run($memory, 12, 2) . PHP_EOL;

/**
 * @param int[] $memory
 * @param int $noun
 * @param int $verb
 */
function run(array $memory, int $noun, int $verb): int
{
    $memory[1] = $noun;
    $memory[2] = $verb;

    // instruction pointer
    $ip = 0;

    while (true) {
        if ($memory[$ip] === 99) {
            return $memory[0];
        }

        if ($memory[$ip] === 1) {
            $memory[$memory[$ip + 3]] = $memory[$memory[$ip + 1]] + $memory[$memory[$ip + 2]];
        } else {
            $memory[$memory[$ip + 3]] = $memory[$memory[$ip + 1]] * $memory[$memory[$ip + 2]];
        }

        $ip += 4;
    }
}
