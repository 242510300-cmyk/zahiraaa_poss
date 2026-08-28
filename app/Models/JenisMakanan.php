<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMakanan extends Model
{
    use HasFactory;

    protected $table = 'jenis_makanans'; // Sesuaikan nama tabel jika di database berbeda

    protected $fillable = ['nama'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'jenis_makanan_id');
    }
}