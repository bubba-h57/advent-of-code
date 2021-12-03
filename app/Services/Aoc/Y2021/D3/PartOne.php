<?php
namespace App\Services\Aoc\Y2021\D3;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    protected int $day = 3;

    public function solve(): bool
    {
        $input = $this->input();

        $bits = $input->reduce(
            function ($carry, $bit) {
                return $bit->map(
                    function ($value, $key) use (&$carry) {
                        return \collect($carry)->get($key, 0) + $value;
                    }
                );
            },
            []
        );

        $count = $input->count();

        $gamma = $bits->map(
            function ($value, $key) use ($count) {
                return (int) ($count - $value < $value);
            }
        )->implode('');

        $epsilon = strtr($gamma, '01', '10');

        $powerConsumption = bindec($gamma) * bindec($epsilon);
        
        $this->info(sprintf('Submarine Power Consumption is %s.', $powerConsumption));

        return true;
    }

    protected function input(): Collection
    {
        $input = rtrim(Cache::get(Helpers::key($this->year, $this->day)));
        return collect(array_map(function ($value) {
            return collect(str_split($value));
        }, explode("\n", $input)));
    }
}
