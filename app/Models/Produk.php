<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'category',
        'jenis_makanan_id',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

    public function itemPenjualan()
    {
        return $this->hasMany(itemPenjualan::class, 'produk_id');
    }

    public function jenisMakanan()
{
    // Tambahkan 'jenis_makanan_id' sebagai argumen kedua
    return $this->belongsTo(JenisMakanan::class, 'jenis_makanan_id');
}
}