<?php
namespace App\Services;

use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\App;
use NumberFormatter;
use Illuminate\Contracts\Container\BindingResolutionException;

class Aoc
{
    public static function solve(string $year, string $day, string $part, OutputStyle $output): int
    {
        $part =  ucfirst((new NumberFormatter('en', NumberFormatter::SPELLOUT))->format($part));
        $class = sprintf('App\Services\Aoc\Y%s\D%s\Part%s', $year, $day, $part);
        try {
            App::make($class)->output($output)->solve();
        } catch (BindingResolutionException $bre) {
            $output->warning($class . ' needs to be implemented.');
        }
        
        return 0;
    }
}
