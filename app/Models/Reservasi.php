<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ruangan;
use App\Models\PaketMenu;

class Reservasi extends Model
{
    protected $table = 'reservasi'; // opsional, kalau nama tabel beda dari default

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jumlah_orang',
        'id_ruangan',
        'paket_menu',
        'total_bayar',
        'status'
    ];

    // Relasi ke ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    // Relasi ke paket menu
    public function paketMenu()
    {
        return $this->belongsTo(PaketMenu::class, 'paket_menu');
    }

    // (Opsional) Relasi ke user, kalau kamu pakai auth
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
