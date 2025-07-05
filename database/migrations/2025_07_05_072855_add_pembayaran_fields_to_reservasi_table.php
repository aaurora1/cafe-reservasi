<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Di dalam migration-nya
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('metode_pembayaran')->nullable();
            $table->string('status')->nullable(); // atau status_pembayaran jika kamu pakai nama itu
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            //
        });
    }
};
