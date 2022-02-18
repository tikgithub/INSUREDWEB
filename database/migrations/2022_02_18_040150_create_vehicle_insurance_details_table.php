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
        Schema::create('vehicle_insurance_details', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('sex');
            $table->date('dob');
            $table->string('tel');
            $table->string('identity');
            $table->integer('province');
            $table->integer('district');
            $table->longText('address');
            $table->integer('vehicle_brand');
            $table->string('number_plate');
            $table->string('color');
            $table->integer('registered_province');
            $table->longText('front_image');
            $table->longText('left_image');
            $table->longText('right_image');
            $table->longText('rear_image');
            $table->longText('yellow_book_image');
            $table->string('contract_no')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('fee_charge',18,2);
            $table->decimal('total_price',18,2);
            $table->string('contract_status')->nullable(); //WAIT_FOR_PAYMENT, WAIT_FOR_APPROVED, APPROVED_OK
            $table->longText('payment_confirm')->nullable();//For upload the payment confirm image or slip of payment
            $table->dateTime('payment_time')->nullable();//Payment time when customer upload slip or press for payment
            $table->dateTime('approved_time')->nullable();//When admin approve the detail
            $table->longText('contact_description')->nullable();//
            $table->integer('sale_options_id');// FK from Sale_Option table

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
        Schema::dropIfExists('vehicle_insurance_details');
    }
};
