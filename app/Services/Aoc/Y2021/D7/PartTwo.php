<?php
namespace App\Services\Aoc\Y2021\D7;

class PartTwo extends PartOne
{
    protected bool $partB = true;

    public function solve(): bool
    {
        $this->handle();
        $this->info(sprintf('Fuel Spent for Alignment: %s', $this->fuel));
        return true;
    }
}
