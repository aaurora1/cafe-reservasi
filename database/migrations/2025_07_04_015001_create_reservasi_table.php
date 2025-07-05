<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    { {
            Schema::create('reservasi', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_user')->constrained('users');
                $table->string('nama');
                $table->string('email');
                $table->string('telepon');
                $table->date('tanggal');
                $table->time('jam_mulai');
                $table->time('jam_selesai');
                $table->string('ruangan');
                $table->string('paket');
                $table->integer('jumlah_orang');
                $table->integer('harga_paket');
                $table->integer('total_bayar'); // ✅ tambahkan ini
                $table->text('catatan')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
