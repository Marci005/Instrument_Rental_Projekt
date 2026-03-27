<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * created the rents table and its datas
     * + has a dropifexist function
     */
    public function up(): void
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('instrument_id')->constrained('instruments')->onDelete('cascade');
            $table->integer('rent_price')->nullable(false);
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable();
            $table->date('real_end_date')->nullable();
            $table->timestamps();




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
