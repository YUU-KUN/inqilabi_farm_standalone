<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Report;

class DashboardController extends Controller
{
    public function dashboard() {
        $dashboard['jumlahPengguna'] = User::count();
        $dashboard['totalPemesananKurban'] = Kurban::count();
        return $dashboard;
    }
    
    public function getTotalPesanan(Request $request)
    {
        return Pembayaran::where('status', 'success')->count();
    }

    public function getTotalUsers(Request $request)
    {
        return User::where('level', 'user')->count();
    }

    public function getKurbanBerlangsung(Request $request)
    {
        return Report::where([['penerima', null], ['hari_diterima', null], ['pukul_diterima', null]])->count();
    }

    public function getWaitingTransaction(Request $request)
    {
        return Pembayaran::where('status', 'pending')->count();
    }
    
    public function getKurbanTerselesaikan(Request $request)
    {
        return Report::where([['penerima', '!=', null], ['hari_diterima', '!=', null], ['pukul_diterima', '!=', null]])->count();
    }

    public function getSuccessTransaction(Request $request)
    {
        return Pembayaran::where('status', 'success')->count();
    }
}
