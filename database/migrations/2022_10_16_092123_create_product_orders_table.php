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
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->boolean('delivery_method');
            $table->string('customer_address')->nullable();
            $table->longText('other_request')->nullable();
            $table->boolean('is_invoice');
            $table->boolean('is_call_other');
            $table->float('total_price');

            $table->integer('status');
            $table->timestamps();

            $table->unsignedBigInteger('store_province_id')->nullable();
            $table->string('store_province_name')->nullable();
            $table->unsignedBigInteger('store_district_id')->nullable();
            $table->string('store_district_name')->nullable();
            $table->unsignedBigInteger('store_address_id')->nullable();

            $table->unsignedBigInteger('customer_province_id')->nullable();
            $table->string('customer_province_name')->nullable();
            $table->unsignedBigInteger('customer_district_id')->nullable();
            $table->string('customer_district_name')->nullable();

            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->string('payment_method_name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();

            $table->foreign('store_province_id')->references('id')->on('category_vn_provinces')->onDelete('cascade');
            $table->foreign('store_district_id')->references('id')->on('category_vn_districts')->onDelete('cascade');
            $table->foreign('store_address_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('customer_province_id')->references('id')->on('category_vn_provinces')->onDelete('cascade');
            $table->foreign('customer_district_id')->references('id')->on('category_vn_districts')->onDelete('cascade');

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
};
