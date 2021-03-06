<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $fillable = ['user_id', 'package_id', 'nama', 'jumlah', 'total', 'dedikasi', 'proses', 'bukti_transfer', 'status'];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function Package() {
        return $this->belongsTo('App\Models\Packages', 'package_id');
    }

    public function Report() {
        return $this->hasMany('App\Models\Report', 'id_pembayaran');
    }
}
