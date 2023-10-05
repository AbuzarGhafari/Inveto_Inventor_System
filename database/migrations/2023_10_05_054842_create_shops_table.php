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
            $table->string('route_main_area');
            $table->string('location_sub_area');
            $table->string('channel');
            $table->string('shop_type');
            $table->string('shop_sub_type');
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
