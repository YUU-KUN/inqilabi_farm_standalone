<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $fillable = [
        'id_pembayaran', 
        'nama', 
        'jenis_hewan', 
        'berat_hewan', 
        'lokasi_pembagian', 
        'hari_penyembelihan', 
        'pukul_penyembelihan', 
        'penyembelih', 
        'penanggung_jawab', 
        'hari_pembagian', 
        'foto', 
        'proses', 
        'isReported'
    ];
}
