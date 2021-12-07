<?php
namespace App\Services\Aoc\Y2021\D5;

class PartTwo extends PartOne
{
    protected bool $includeDiagonals = true;

    public function solve(): bool
    {
        $result =  $this->getNumberOfDangerousPoints();
        $this->info(sprintf('Overlapping Point Count is %s.', $result));
        return true;
    }
}
