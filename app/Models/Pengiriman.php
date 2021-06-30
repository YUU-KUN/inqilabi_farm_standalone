<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengirimans';
    protected $fillable = ['id_pembayaran', 'nama_penerima', 'no_wa', 'tempat_penerima', 'alamat', 'kecamatan', 'kota', 'provinsi'];
}
