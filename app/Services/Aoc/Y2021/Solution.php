<?php
namespace App\Services\Aoc\Y2021;

use Illuminate\Console\OutputStyle;

class Solution
{
    /**
     * Day of Advent
     * @var int
     */
    protected int $day = 1;
    /**
     * Year of Advent
     * @var int
     */
    protected int $year = 2021;
    /**
     * Console Output
     * @var null|OutputStyle
     */
    protected ?OutputStyle $output = null;

    /**
     * Helper function for output
     * @param string $message
     * @return void
     */
    public function info(string $message): void
    {
        if (empty($this->output)) {
            return;
        }

        $this->output->info($message);
    }

    /**
     * Setter/Getter for output
     * @param null|OutputStyle $output
     * @return OutputStyle
     */
    public function output(?OutputStyle $output=null): Solution
    {
        $this->output = $output ?? $this->output;
        return $this;
    }

    /**
     * Solution
     * @return bool
     */
    public function solve(): bool
    {
        $this->info('Solution needs to be implemented');

        return false;
    }
}
