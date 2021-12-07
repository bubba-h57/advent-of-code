<?php
namespace App\Services\Aoc\Y2021\D6;

class PartTwo extends PartOne
{
    public function solve(): bool
    {
        $result = $this->countFish(256);
        $this->info(sprintf('%s Lantern Fish after 256 days.', number_format($result)));
        return true;
    }
}
