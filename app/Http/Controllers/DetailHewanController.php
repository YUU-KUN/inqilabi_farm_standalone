<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\DetailHewan;

class DetailHewanController extends Controller
{
    public function getHewanDetail(Request $request) 
    {
        $detailHewan = DetailHewan::where('id_pembayaran', $request->id_pembayaran)->first();
        return $detailHewan;
    }

    public function laporkan() 
    {
        
    }
}
