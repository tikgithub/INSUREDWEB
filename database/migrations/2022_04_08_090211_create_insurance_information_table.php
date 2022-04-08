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
        Schema::create('insurance_information', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('tel')->nullable();
            $table->string('identity')->nullable();
            $table->integer('province')->nullable();
            $table->integer('district')->nullable();
            $table->longText('address')->nullable();
            $table->integer('vehicle_brand')->nullable();
            $table->string('number_plate')->nullable();
            $table->string('color')->nullable();
            $table->integer('registered_province')->nullable();
            $table->longText('front_image')->nullable();
            $table->longText('left_image')->nullable();
            $table->longText('right_image')->nullable();
            $table->longText('rear_image')->nullable();
            $table->longText('yellow_book_image')->nullable();
            $table->string('contract_no')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('fee_charge',18,2);
            $table->decimal('total_price',18,2);
            $table->string('engine_number')->nullable();
            $table->string('chassic_number')->nullable();
            $table->string('contract_status')->nullable(); //WAIT_FOR_PAYMENT, WAIT_FOR_APPROVED, APPROVED_OK
            $table->longText('payment_confirm')->nullable();//For upload the payment confirm image or slip of payment
            $table->dateTime('payment_time')->nullable();//Payment time when customer upload slip or press for payment
            $table->dateTime('approved_time')->nullable();//When admin approve the detail
            $table->dateTime('contract_available_time')->nullable();// Time when the contract is being
            $table->longText('contact_description')->nullable();//
            $table->integer('insurance_type_id')->nullable();// FK from insurance table data which customer update it is will comnbine with insurance type column
            $table->string('insurance_Type')->nullable();//Tell that which insurance is belong to the record
            $table->integer('user_id')->nullable();//User Id which use to buying
            $table->integer('approve_by')->nullable();//User which approve the insurance contract
            $table->longText('slipUploaded')->nullable();
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
        Schema::dropIfExists('insurance_information');
    }
};
