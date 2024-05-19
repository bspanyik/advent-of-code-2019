<?php

use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
;

return (new PhpCsFixer\Config())
 ->setParallelConfig(ParallelConfigFactory::detect())
 ->setRules([
        '@PER-CS2.0' => true,
    ])
    ->setFinder($finder)
;
