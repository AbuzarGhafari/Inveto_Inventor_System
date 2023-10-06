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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->string('shopkeeper_name');
            $table->string('shopkeeper_mobile');
            $table->string('city');
            $table->string('address');  
            $table->string('channel');
            
            $table->unsignedBigInteger('main_area')->nullable();
            $table->foreign('main_area')->references('id')->on('areas')->nullOnDelete();
            
            $table->unsignedBigInteger('sub_area')->nullable();
            $table->foreign('sub_area')->references('id')->on('sub_areas')->nullOnDelete();

            
            $table->unsignedBigInteger('shop_type')->nullable();
            $table->foreign('shop_type')->references('id')->on('shop_types')->nullOnDelete();
            
            $table->unsignedBigInteger('shop_sub_type')->nullable();
            $table->foreign('shop_sub_type')->references('id')->on('shop_sub_types')->nullOnDelete();
 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
