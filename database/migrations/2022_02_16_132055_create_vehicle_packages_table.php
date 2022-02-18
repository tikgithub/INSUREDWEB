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
        Schema::create('vehicle_packages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->decimal('start_rank')->nullable();
            $table->decimal('end_rank')->nullable();
            $table->integer('lvl_id'); //Level ID
            $table->integer('c_id');//Company ID
            $table->boolean('status');//On/Off
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
        Schema::dropIfExists('vehicle_packages');
    }
};
