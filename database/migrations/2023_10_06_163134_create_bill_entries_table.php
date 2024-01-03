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
        Schema::create('bill_entries', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number');
            
            $table->unsignedBigInteger('bill_id');
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
               
            $table->string('sku_code');
            $table->double('distributor_prices')->default(0);
            $table->integer('pack_size')->default(0);
            $table->integer('assigned_price');
            $table->integer('no_of_cottons');
            $table->integer('no_of_pieces');
            $table->double('cottons_price');
            $table->double('peices_price');
            $table->double('total_price');
            $table->double('discount');
            $table->double('final_price');
               
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_entries');
    }
};
