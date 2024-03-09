<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=['id_user','id_akses'];
    
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function akses()
    {
        return $this->belongsTo(akses::class,'id_akses','id');
    }
}
