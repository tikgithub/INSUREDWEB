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
        Schema::create('accident_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('sex');
            $table->date('dob');
            $table->string('identity');
            $table->string('tel');
            $table->integer('province');
            $table->integer('district');
            $table->string('address');
            $table->string('reference_photo');
            $table->string('contract_status')->nullable();
            $table->string('contract_no')->nullable();
            $table->dateTime('payment_time')->nullable();
            $table->integer('approve_user')->nullable();
            $table->longText('detail')->nullable();
            $table->dateTime('approve_time')->nullable();
            $table->decimal('fee',18,2)->nullable();
            $table->decimal('total_price',18,2)->nullable();
            $table->integer('plan_id');
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
        Schema::dropIfExists('accident_inputs');
    }
};
