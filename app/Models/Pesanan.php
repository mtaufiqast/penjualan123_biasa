<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = ['id_penjualan', 'id_produk', 'jumlah'];

    public function Produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
