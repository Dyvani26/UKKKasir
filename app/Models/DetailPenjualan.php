<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = ['id_barang','jumlah_barang','total','sesi'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
    public function penjualan()
    {
       return $this->belongsTo(Penjualan::class,'id_penjualan','id');
    }
}
