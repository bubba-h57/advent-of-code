<?php
namespace App\Services\Aoc\Y2021\D1;

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
        $measurements = collect(array_map('intval', explode("\n", $input)));

        $groupedMeasurements = $measurements->map(function ($currentValue, $currentKey) use ($measurements) {
            if ($currentKey >= $measurements->count() - 2) {
                return null;
            }

            return $currentValue + $measurements->get($currentKey + 1) + $measurements->get($currentKey + 2);
        });
        
        $filteredGroupedMeasurements = $groupedMeasurements->filter(function ($value, $key) {
            return is_null($value) === false;
        });

        $increments = $filteredGroupedMeasurements->filter(function ($currentValue, $currentKey) use ($filteredGroupedMeasurements) {
            if ($currentKey === 0) {
                return false;
            }
            return $currentValue > $filteredGroupedMeasurements->get($currentKey - 1);
        });

        $this->info(sprintf('Measurements increased %s times.', $increments->count()));
        return true;
    }
}
