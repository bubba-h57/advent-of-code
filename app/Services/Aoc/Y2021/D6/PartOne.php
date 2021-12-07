<?php
namespace App\Services\Aoc\Y2021\D6;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    protected int $day = 6;
    protected Collection $fish;
    protected Collection $fishByDay;

    public function solve(): bool
    {
        $result = $this->countFish(80);
        $this->info(sprintf('%s Lantern Fish after 80 days.', number_format($result)));
        return true;
    }

    protected function input(): void
    {
        $this->fish = collect(array_map('intval', explode(',', Cache::get(Helpers::key($this->year, $this->day)))));
    }

    protected function countFish(int $days): int
    {
        $this->input();
        $this->fishByDay = collect(array_fill_keys(range(0, 8), 0));

        $this->fish->each(function ($day) {
            $this->fishByDay->put($day, $this->fishByDay->get($day)+1);
        });

        for ($i = 0; $i < $days; $i++) {
            $this->fishByDay->each(function ($numberOfFish, $day) {
                if ($day === 0) {
                    $this->fishByDay[8] += $numberOfFish;
                    $this->fishByDay[6] += $numberOfFish;
                    $this->fishByDay[0] -= $numberOfFish;
                } else {
                    $this->fishByDay[$day - 1] += $numberOfFish;
                    $this->fishByDay[$day] -= $numberOfFish;
                }
            });
        }

        return $this->fishByDay->sum();
    }
}
