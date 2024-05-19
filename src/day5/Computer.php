<?php

declare(strict_types=1);

class Computer
{
    /** @var int[] */
    private array $RAM;

    // instruction pointer
    private int $ip;

    private int $instruction;

    /**
     * @param int[] $memoryMap
    */
    public function __construct(array $memoryMap)
    {
        $this->RAM = $memoryMap;
        $this->ip = 0;
    }

    public function run(int $input, bool $debug = false): void
    {
        while (true) {
            $this->instruction = $this->RAM[$this->ip];

            $opCode = $this->instruction % 100;
            if ($opCode === 99) {
                die(PHP_EOL);
            }

            if ($debug) {
                echo $this->instruction . ' | ' . $opCode . PHP_EOL;
            }

            match ($opCode) {
                1 => $this->add(),
                2 => $this->mul(),
                3 => $this->inp($input),
                4 => $this->out(),
                5 => $this->jnz(),
                6 => $this->jz(),
                7 => $this->lt(),
                8 => $this->eq(),
                default => die('Illegal $opCode: ' . $opCode . PHP_EOL),
            };
        }
    }

    private function getA(): int
    {
        $p = $this->RAM[$this->ip + 1];

        return $this->instruction / 100 % 10 > 0 ? $p : $this->RAM[$p];
    }

    private function getB(): int
    {
        $p = $this->RAM[$this->ip + 2];

        return $this->instruction / 1000 % 10 > 0 ? $p : $this->RAM[$p];
    }

    private function add(): void
    {
        $p = $this->RAM[$this->ip + 3];
        $this->RAM[$p] = $this->getA() + $this->getB();
        $this->ip += 4;
    }

    private function mul(): void
    {
        $p = $this->RAM[$this->ip + 3];
        $this->RAM[$p] = $this->getA() * $this->getB();
        $this->ip += 4;
    }

    private function inp(int $input): void
    {
        $p = $this->RAM[$this->ip + 1];
        $this->RAM[$p] = $input;
        $this->ip += 2;
    }

    private function out(): void
    {
        echo $this->getA() . PHP_EOL;
        $this->ip += 2;
    }

    private function jnz(): void
    {
        if ($this->getA() !== 0) {
            $this->ip = $this->getB();
        } else {
            $this->ip += 3;
        }
    }

    private function jz(): void
    {
        if ($this->getA() === 0) {
            $this->ip = $this->getB();
        } else {
            $this->ip += 3;
        }
    }

    private function lt(): void
    {
        $p = $this->RAM[$this->ip + 3];
        $this->RAM[$p] = $this->getA() < $this->getB() ? 1 : 0;
        $this->ip += 4;
    }

    private function eq(): void
    {
        $p = $this->RAM[$this->ip + 3];
        $this->RAM[$p] = $this->getA() === $this->getB() ? 1 : 0;
        $this->ip += 4;
    }

}
