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
        Schema::create('input_group_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vid_id');//Vehicle_Insurance_Detail
            $table->integer('igc_id');//Input_Group_Cover
            $table->string('item_name');//Name of item
            $table->decimal('item_price');//Price
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
        Schema::dropIfExists('input_group_items');
    }
};
