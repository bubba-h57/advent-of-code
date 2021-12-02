<?php
namespace App\Services\Aoc\Y2021\D1;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;

use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    public function solve(): bool
    {
        $input = Cache::get(Helpers::key($this->year, $this->day));
        $measurements = collect(array_map('intval', explode("\n", $input)));
        $increases = $measurements->filter(function ($currentValue, $currentKey) use ($measurements) {
            if ($currentKey === 0) {
                return false;
            }
            return $currentValue > $measurements->get($currentKey - 1);
        });

        $this->info(sprintf('Measurements increased %s times.', $increases->count()));
        return true;
    }
}
