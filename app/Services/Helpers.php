<?php

namespace App\Services;



class Helpers 
{

    static public function key(int $year, int $day): string
    {
        return sprintf(config('app.aoc_cache_key_format'), $year, $day);
    }

}