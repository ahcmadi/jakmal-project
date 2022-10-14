<?php

use Illuminate\Database\Seeder;
use Database\Seeders\init_seed;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(init_seed::class);
    }
}
