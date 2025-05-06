<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_peminjaman');
    }
}
