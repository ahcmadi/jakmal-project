<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class init_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get("./database/products.json");
        $source_file = json_decode($file, true);
        
        DB::table('product')->insert($source_file);
        
        $file = File::get("./database/reviews.json");
        $source_file = json_decode($file, true);
        DB::table('review')->insert($source_file);
    }
}
