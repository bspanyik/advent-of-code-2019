<?php

declare(strict_types=1);

$input = file_get_contents($argv[1] ?? 'input.txt');
if ($input === false) {
    die('There\'s something wrong with the input file. I don\'t know what it is.' . PHP_EOL);
}

$memory = array_map('intval', explode(',', $input));

require 'Computer.php';
(new Computer($memory))->run(1);
