<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adds pricing columns to the instruments table:
     *  - monthly_price : monthly rental fee in HUF
     *  - deposit       : security deposit required when renting
     *  - image         : optional path/URL to the instrument image
     *
     * These fields are required by the frontend for rent cost calculation
     * and display on instrument cards.
     */
    public function up(): void
    {
        Schema::table('instruments', function (Blueprint $table) {
            $table->unsignedInteger('monthly_price')->default(0)->after('description');
            $table->unsignedInteger('deposit')->default(0)->after('monthly_price');
            $table->string('image')->nullable()->after('deposit');
        });
    }

    /**
     * Drops the added columns in reverse order.
     */
    public function down(): void
    {
        Schema::table('instruments', function (Blueprint $table) {
            $table->dropColumn(['monthly_price', 'deposit', 'image']);
        });
    }
};
