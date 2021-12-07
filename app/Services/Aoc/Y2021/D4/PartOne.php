<?php
namespace App\Services\Aoc\Y2021\D4;

use App\Services\Aoc\Y2021\Solution;
use App\Services\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PartOne extends Solution
{
    protected int $day = 4;
    public function solve(): bool
    {
        $input = $this->input();
        $result =  $this->getWinningScore($input);
        $this->info(sprintf('Final Score is %s.', $result));
        return true;
    }

    protected Collection $boards;
    protected Collection $numbers;
    protected array $columnMarks = [];
    protected array $rowMarks = [];
    protected array $results = [];

    protected function getWinningScore(array $game, bool $last = false): int
    {
        $this->numbers = $this->numbers($game);
        $this->boards = collect(array_map(static fn ($b): array => sscanf($b, str_repeat('%d ', 25)), $game));

        $this->numbers->each(function ($number) {
            $this->boards->each(function ($board, $boardIndex) use ($number) {
                $matchIndex = array_search($number, $board, true);

                if ($matchIndex === false) {
                    return;
                }

                $col = $matchIndex % 5;
                $row = (int) floor($matchIndex / 5);

                $this->columnMarks[$boardIndex][$col] = ($this->columnMarks[$boardIndex][$col] ?? 0) + 1;
                $this->rowMarks[$boardIndex][$row] = ($this->rowMarks[$boardIndex][$row] ?? 0) + 1;
                $board[$matchIndex] = null;
                $this->boards->put($boardIndex, $board);

                if ($this->columnMarks[$boardIndex][$col] === 5 || $this->rowMarks[$boardIndex][$row] === 5) {
                    $this->results[$boardIndex] = array_sum($board) * $number;
                    $this->boards->forget($boardIndex);
                }
            });
        });

        return $last ? $this->results[array_key_last($this->results)] : $this->results[array_key_first($this->results)];
    }

    protected function numbers(array &$game): Collection
    {
        return collect(array_map('intval', explode(',', array_shift($game))));
    }

    protected function input(): array
    {
        return explode("\n\n", Cache::get(Helpers::key($this->year, $this->day)));
    }
}
