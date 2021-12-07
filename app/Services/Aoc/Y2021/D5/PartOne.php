<?php
namespace App\Services\Aoc\Y2021\D5;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    protected int $day = 5;
    protected Collection $linesOfVents;
    protected Collection $grid;
    protected bool $includeDiagonals = false;

    public function solve(): bool
    {
        $result =  $this->getNumberOfDangerousPoints();
        $this->info(sprintf('Overlapping Point Count is %s.', $result));
        return true;
    }

    protected function input(): void
    {
        $this->linesOfVents = collect(explode("\n", Cache::get(Helpers::key($this->year, $this->day))));
    }

    
    protected function getNumberOfDangerousPoints(): int
    {
        $this->input();
        $grid = [];

        $this->linesOfVents->each(function ($line) use (&$grid) {
            [$x1, $y1, $x2, $y2] = sscanf($line, '%d,%d -> %d,%d');
            
            if (!$this->includeDiagonals && $x1 !== $x2 && $y1 !== $y2) {
                return;
            }

            $x = $x1;
            $y = $y1;

            collect(range(0, max(abs($x1 - $x2), abs($y1 - $y2))))
                ->each(function () use (&$x, &$y, &$x2, &$y2, &$x1, &$y1, &$grid) {
                    $grid[$y][$x] = ($grid[$y][$x] ?? 0) + 1;
                    $x += $x2 <=> $x1;
                    $y += $y2 <=> $y1;
                });
        });

        $count = 0;

        foreach ($grid as $line) {
            foreach ($line as $vents) {
                $count += $vents > 1;
            }
        }

        return $count;
    }

    protected function getNumberOfDangerousPoints1(string $input, $includeDiagonals = false): int
    {
        $linesDef = explode("\n", $input);
        $grid = [];

        foreach ($linesDef as $lineDef) {
            [$x1, $y1, $x2, $y2] = sscanf($lineDef, '%d,%d -> %d,%d');

            if (!$includeDiagonals && $x1 !== $x2 && $y1 !== $y2) {
                continue;
            }

            $x = $x1;
            $y = $y1;
            $vents = max(abs($x1 - $x2), abs($y1 - $y2));

            for ($i = 0; $i <= $vents; $i++) {
                $grid[$y][$x] = ($grid[$y][$x] ?? 0) + 1;
                $x += $x2 <=> $x1;
                $y += $y2 <=> $y1;
            }
        }

        $count = 0;

        foreach ($grid as $line) {
            foreach ($line as $vents) {
                $count += $vents > 1;
            }
        }

        return $count;
    }
}
