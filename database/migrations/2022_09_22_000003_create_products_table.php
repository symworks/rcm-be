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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('top_features');
            $table->string('description');
            $table->boolean('is_discount');
            $table->boolean('is_trending');
            $table->float('origin_price');
            $table->float('official_price');
            $table->float('average_evaluation');
            $table->integer('total_evaluation');
            $table->string('image_1');
            $table->string('image_2');
            $table->string('image_3');
            $table->string('image_4');
            $table->string('image_5');
            $table->timestamps();

            $table->unsignedBigInteger('producer_id');
            $table->unsignedBigInteger('product_brand_id');
            $table->unsignedBigInteger('category_currency_id');
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('updated_by_id');

            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade');
            $table->foreign('product_brand_id')->references('id')->on('product_brands')->onDelete('cascade');
            $table->foreign('category_currency_id')->references('id')->on('category_currencies')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
