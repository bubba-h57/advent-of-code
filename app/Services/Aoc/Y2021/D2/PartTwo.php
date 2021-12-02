<?php
namespace App\Services\Aoc\Y2021\D2;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Facades\Cache;

class PartTwo extends Solution
{
    protected int $day = 2;

    public function solve(): bool
    {
        $input = Cache::get(Helpers::key($this->year, $this->day));
        $measurements = collect(explode("\n", trim($input)));
        $horizontalPosition = 0;
        $depth = 0;
        $aim = 0;
    
        $measurements->each(function ($instruction) use (&$horizontalPosition, &$depth, &$aim) {
            list($command, $units) = explode(" ", trim($instruction));
            $units = (int)$units;

            switch ($command) {
                    case 'forward':
                        $horizontalPosition = $horizontalPosition + $units;
                        $depth = $depth+ ($aim * $units);
                        break;
                    case 'down':
                        $aim = $aim + (int)$units;
                        break;
                    case 'up':
                        $aim = $aim - (int)$units;
                        break;
                }
        });
        //dd($horizontalPosition, $depth);
        $calculated = $horizontalPosition * $depth;
        $this->info(sprintf('Final horizontal position by Final depth: %s', $calculated));
        return true;
    }
}
