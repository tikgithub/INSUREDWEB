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
        Schema::create('third_party_customer_inputs', function (Blueprint $table) {
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
            $table->string('contract_status')->nullable(); //WAIT_FOR_PAYMENT, WAIT_FOR_APPROVED, APPROVED_OK
            $table->longText('payment_confirm')->nullable();//For upload the payment confirm image or slip of payment
            $table->dateTime('payment_time')->nullable();//Payment time when customer upload slip or press for payment
            $table->dateTime('approved_time')->nullable();//When admin approve the detail
            $table->longText('contact_description')->nullable();//
            $table->text('engine_number')->nullable();
            $table->text('chassic_number')->nullable();
            $table->integer('third_package_id');// FK from ThirdPartyPackage table
            $table->integer('approve_by')->nullable();//Admin who approve
            $table->integer('user_id')->nullable();//User Id which use to buying
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
        Schema::dropIfExists('third_party_customer_inputs');
    }
};
