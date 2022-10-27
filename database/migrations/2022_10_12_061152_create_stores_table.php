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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address_detail');
            $table->timestamps();

            $table->unsignedBigInteger('province_address_id')->nullable();
            $table->string('province_address_name')->nullable();
            $table->unsignedBigInteger('district_address_id')->nullable();
            $table->string('district_address_name')->nullable();
            $table->unsignedBigInteger('ward_address_id')->nullable();
            $table->string('ward_address_name')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();

            $table->foreign('province_address_id')->references('id')->on('category_vn_provinces')->onDelete('cascade');
            $table->foreign('district_address_id')->references('id')->on('category_vn_districts')->onDelete('cascade');
            $table->foreign('ward_address_id')->references('id')->on('category_vn_wards')->onDelete('cascade');

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
