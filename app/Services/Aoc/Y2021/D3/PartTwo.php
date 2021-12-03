<?php
namespace App\Services\Aoc\Y2021\D3;

use Illuminate\Support\Collection;

class PartTwo extends PartOne
{
    public function solve(): bool
    {
        $input = $this->input();
        $oxygenGeneratorRating = $this->calculate($input, 1);
        $co2ScrubberRating = $this->calculate($input, 0);
      
        $lifeSupportRating = bindec($oxygenGeneratorRating) * bindec($co2ScrubberRating);
        $this->info(sprintf('The life support rating of the submarine is %s.', $lifeSupportRating));
        return true;
    }

    public function calculate(Collection $reading, bool $bit)
    {
        $column = 0;
        while ($reading->count() > 1) {
            $bitCount = $reading->pluck($column)->sum();
            $keep = (($reading->count() - $bitCount <= $bitCount) xor !$bit);
            $reading = $reading->filter(function ($bits) use ($keep, $column) {
                return $bits[$column] == $keep;
            });

            $column++;
        }

        $this->info('Report: ' . $reading->first()->implode(''));
        return $reading->first()->implode('');
    }
}
