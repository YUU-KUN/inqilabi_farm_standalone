<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;
    protected $fillable = ['id_pembayaran', 'file'];
    protected $table = 'sertifikats';

    public function Pembayaran()
    {
        return $this->belongsTo('App\Models\Pembayaran', 'id_pembayaran');
    }

    public function Packages()
    {
        return $this->hasMany('App\Models\Pembayaran', 'package_id');
    }
}
