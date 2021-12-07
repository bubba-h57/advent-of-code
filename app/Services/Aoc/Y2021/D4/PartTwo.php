<?php
namespace App\Services\Aoc\Y2021\D4;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Facades\Cache;

class PartTwo extends PartOne
{
    protected int $day = 4;

    public function solve(): bool
    {
        $input = Cache::get(Helpers::key($this->year, $this->day));
        $result =   $this->getWinningScore($input, true);
        $this->info(sprintf('Final Score is %s.', $result));
        return true;
    }
}
