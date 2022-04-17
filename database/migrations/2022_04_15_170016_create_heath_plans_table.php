<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heath_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('cover_type_id');
            $table->decimal('sale_price',18,2);
            $table->decimal('fee',18,2);
            $table->integer('start_age');
            $table->integer('end_age');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heath_plans');
    }
};
