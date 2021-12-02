<?php
namespace App\Services\Aoc\Y2021\D23;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;

use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    public function solve(): bool
    {
        $input = Cache::get(Helpers::key($this->year, $this->day));
        return true;
    }
}
