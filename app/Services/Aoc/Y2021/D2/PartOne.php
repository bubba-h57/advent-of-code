<?php
namespace App\Services\Aoc\Y2021\D2;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;

use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    protected int $day = 2;

    public function solve(): bool
    {
        $input = Cache::get(Helpers::key($this->year, $this->day));
        $measurements = collect(explode("\n", trim($input)));
        $horizontalPosition = 0;
        $depth = 0;

        $measurements->each(function ($instruction) use (&$horizontalPosition, &$depth) {
            list($direction, $units) = explode(" ", trim($instruction));

            switch ($direction) {
                case 'forward':
                    $horizontalPosition = $horizontalPosition + (int)$units;
                    break;
                case 'down':
                    $depth = $depth + (int)$units;
                    break;
                case 'up':
                    $depth = $depth - (int)$units;
                    break;
            }
        });

        $calculated = $horizontalPosition * $depth;
        $this->info(sprintf('Final horizontal position by Final depth: %s', $calculated));
        return true;
    }
}
