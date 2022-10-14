<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Cache;

class CacheClear extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'cache:clear';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Clear Cache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Cache::flush();
    }
}
