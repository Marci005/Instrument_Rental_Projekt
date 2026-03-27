<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * created the users table and its datas
     * + has a dropifexist function
     */

    public function up(): void
    {
        Schema::create('addresses', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('address_type', ['számlázási', 'szállítási', 'mindkettő']);
            $table->integer('zip', 50)->nullable(false);
            $table->string('settlement', 100)->nullable(false);
            $table->string('street', 100)->nullable(false);
            $table->string('street_type', 30)->nullable(false);
            $table->string('house_number', 100)->nullable(false);
            $table->smallInteger('floor_number', 20)->nullable();
            $table->smallInteger('door_number', 20)->nullable();
            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
