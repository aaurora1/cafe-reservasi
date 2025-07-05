<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketMenu extends Model
{
    protected $table = 'paket_menu';

    protected $fillable = [
        'nama_paket', 'deskripsi', 'harga'
    ];
}
