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
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('instrument_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('instrument_brands')->onDelete('cascade');
            $table->enum('condition', ['Új', 'Újszerű', 'Használt']);
            $table->string('title', 100)->nullable(false);
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruments');
    }
};
