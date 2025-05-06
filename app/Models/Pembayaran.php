<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Pembayaran extends Model
{
    use HasFactory;


    protected $table = 'pembayaran';

    protected $fillable = [
        'id_peminjaman',
        'jumlah_pembayaran',
        'tanggal_bayar',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Relasi dengan model Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}
