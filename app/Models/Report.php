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
        'hari_pembagian',
        'supir',
        'no_supir',
        'mobil_pengirim',
        'penerima',
        'hari_diterima',
        'pukul_diterima',
        'isReported'
    ];

    public function Pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}
