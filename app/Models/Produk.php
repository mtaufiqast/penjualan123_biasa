<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = ['kode_product', 'name', 'price', 'stock'];
    // protected $table = 'products';

    public function Produk()
    {
        return $this->hasMany(Produk::class, 'id_produk', 'id');
    }
}
