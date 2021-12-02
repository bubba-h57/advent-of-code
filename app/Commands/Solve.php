<?php

declare(strict_types=1);

namespace App\Commands;

use App\Services\Aoc;
use Illuminate\Support\Carbon;
use LaravelZero\Framework\Commands\Command;

class Solve extends Command
{
    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Solve a puzzle.';

    public function __construct()
    {
        $this->signature = 'solve
        {--year=' . Carbon::now()->format('Y') . ' : Which year for context.}
        {--day=' . Carbon::now()->format('j') . ' : The day to solve.}
        {--part=1 : The part [1 or 2] to solve.}';

        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        return Aoc::solve($this->option('year'), $this->option('day'), $this->option('part'), $this->getOutput());
    }
}
