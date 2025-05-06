<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggota;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'id_anggota',
        'tanggal_pinjam',
        'jumlah_pinjam',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Relasi dengan model Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');  // 'id_anggota' sebagai foreign key
    }

    // Relasi dengan model Pembayaran (menggunakan 'id_peminjaman' sebagai foreign key)
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_peminjaman');  // Menggunakan 'id_peminjaman' sebagai foreign key
    }
}
