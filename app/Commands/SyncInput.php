<?php

namespace App\Commands;

use App\Http\Client\AocClient;
use Illuminate\Support\Carbon;
use LaravelZero\Framework\Commands\Command;

class SyncInput extends Command
{
    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Synchronizes the puzzle input.';

    public function __construct()
    {
        $this->signature = 'sync-input
        {--year=' . Carbon::now()->format('Y') . ' : Which year to synchronize with.}
        {--day=' . Carbon::now()->format('j') . ' : The day to sync input for.}
        {--force : Force synchronization.}';

        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(AocClient $aoc)
    {
        $aoc->sync($this->option('year'),  $this->option('day'),  $this->option('force'), $this->getOutput());
    }
}
