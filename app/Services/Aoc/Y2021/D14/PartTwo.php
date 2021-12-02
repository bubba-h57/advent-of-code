<?php
namespace App\Services\Aoc\Y2021\D14;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Facades\Cache;

class PartTwo extends Solution
{
    protected int $day = 1;
    protected int $year = 2021;

    
    public function solve(): bool
    {
        $input = Cache::get(Helpers::key($this->year, $this->day));
        return true;
    }
}
