<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the instrument_brands table and its columns.
     * + has a dropIfExists function
     */
    public function up(): void
    {
        Schema::create('instrument_brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->nullable(false);
            $table->text('brand_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrument_brands');
    }
};
