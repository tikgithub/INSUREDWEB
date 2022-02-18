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
        Schema::create('sale_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');//option name
            $table->decimal('sale_price',18,2);
            $table->decimal('fee_charge',18,2);
            $table->integer('vp_id');//Vehicle Package ID
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
        Schema::dropIfExists('sale_options');
    }
};
