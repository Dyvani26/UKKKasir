<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable =['id_user','id_categori','photo','nama_barang','harga','stok','jml_terjual'];
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function categori(){
        return $this->belongsTo(Categori::class,'id_categori','id');
    }
    public function barang()
    {
        return $this->hashMany(DetailPenjualan::class,'id','id_barang');
    }
}
