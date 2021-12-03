<?php
namespace App\Services\Aoc\Y2021;

use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Console\OutputStyle;

class Solution
{
    use InteractsWithIO;

    /**
     * Day of Advent
     * @var int
     */
    protected int $day = 1;
    /**
     * Year of Advent
     * @var int
     */
    protected int $year = 2021;


    /**
     * Solution
     * @return bool
     */
    public function solve(): bool
    {
        $this->info('Solution needs to be implemented');

        return false;
    }
}
