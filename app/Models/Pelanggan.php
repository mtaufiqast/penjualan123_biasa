<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    public function Pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_pelanggan', 'id');
    }
}
