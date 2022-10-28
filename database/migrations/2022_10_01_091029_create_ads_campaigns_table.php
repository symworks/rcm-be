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
        Schema::create('ads_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original');
            $table->string('thumbnail');
            $table->string('link_to_campaign')->nullable();
            $table->boolean('is_active');
            $table->timestamps();

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();

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
        Schema::dropIfExists('ads_campaigns');
    }
};
