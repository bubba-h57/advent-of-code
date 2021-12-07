<?php
namespace App\Services\Aoc\Y2021\D7;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    protected int $day = 7;
    protected int $fuel = PHP_INT_MAX;
    protected Collection $positions;
    protected Collection $crabPositions;
    protected int $minPosition;
    protected int $maxPosition;
    protected bool $partB = false;

    public function solve(): bool
    {
        $this->handle();
        $this->info(sprintf('Fuel Spent for Alignment: %s', $this->fuel));
        return true;
    }

    protected function input(): void
    {
        $this->crabPositions = collect(array_map('intval', explode(',', Cache::get(Helpers::key($this->year, $this->day)))));
        $this->minPosition = $this->crabPositions->min();
        $this->maxPosition = $this->crabPositions->max();
        $this->positions = collect(range($this->minPosition, $this->maxPosition));
    }

    protected function handle(): void
    {
        $this->input();
        $this->positions->each(function ($position) {
            $fuelSum = 0;
            $this->crabPositions->each(function ($crab) use ($position, &$fuelSum) {
                $steps = abs($crab - $position);
                if ($this->partB) {
                    $steps = $steps * ($steps + 1) / 2;
                }
                $fuelSum += $steps;
            });
            $this->fuel = min($this->fuel, $fuelSum);
        });
    }
}
