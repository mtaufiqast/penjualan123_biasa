<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = ['id_pelanggan', 'tanggal', 'total_amount', 'paid_amount', 'change_amount', 'status'];

    public function Pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }

    public function detail()
    {
        return $this->hasMany(Pesanan::class, 'id_penjualan');
    }
}
