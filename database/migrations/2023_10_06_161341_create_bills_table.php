<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number')->unique();
               
            $table->unsignedBigInteger('order_booker_id')->nullable();
            $table->foreign('order_booker_id')->references('id')->on('order_bookers')->nullOnDelete();
               
            $table->unsignedBigInteger('main_area_id')->nullable();
            $table->foreign('main_area_id')->references('id')->on('areas')->nullOnDelete();
               
            $table->unsignedBigInteger('sub_area_id')->nullable();
            $table->foreign('sub_area_id')->references('id')->on('sub_areas')->nullOnDelete();
               
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')->nullOnDelete();

            $table->integer('status');
          
            $table->double('actual_price');
            $table->double('discount');
            $table->double('final_price');
            $table->double('recovered_amount');
            $table->boolean('is_recovered');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
