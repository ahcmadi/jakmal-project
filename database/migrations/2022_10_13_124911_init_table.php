<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Storage::put("reminders.txt", "Task 1");
        
        
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
        });
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('rating');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
        Schema::dropIfExists('product');
    }
}
