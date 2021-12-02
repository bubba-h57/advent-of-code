<?php

declare(strict_types=1);

namespace App\Http\Client;

use App\Exceptions\AocException;
use App\Exceptions\SessionTokenNotFound;
use App\Services\Helpers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Console\OutputStyle;

class AocClient
{

    public function sync(int $year, int $day, bool $force = false, OutputStyle $output): void
    {

        $key = Helpers::key($year, $day);

        if ($force) {
            Cache::forget($key);
            $output->info('Forgetting ' . $key);
        }

        if (Cache::has($key)) {
            $output->info('Already Cached ' . $key);
            return;
        }

        Cache::put($key, $this->get($year, $day));
        $output->info('Cached ' . $key);
    }

    protected function key(int $year, int $day): string
    {
        return sprintf(config('app.aoc_cache_key_format'), $year, $day);
    }


    private function get(int $year, int $day): ?string
    {
        if (empty(config('app.session_token'))) {
            throw new SessionTokenNotFound();
        }

        $return = Http::withCookies(
            ['session' => config('app.session_token')], config('app.aoc_domain'))
            ->get(sprintf(config('app.aoc_endpoint'), config('app.aoc_domain'), $year, $day));

        if ($return->failed()) {
            throw new AocException('No Input Found');
        }

        return $return->body();
    }
}