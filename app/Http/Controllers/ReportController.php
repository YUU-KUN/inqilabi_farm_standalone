<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Pembayaran;
use Auth;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Pembayaran::where('status', 'success')->with('Package')->get();
        return $laporan;
    }

    public function getReportDetail(Request $request) {
        $reportDetail = Report::where('id_pembayaran', $request->id_pembayaran)->get();
        return $reportDetail;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // $input['foto'] = $request->foto->store('public/reports');
        
        $image = $request->foto;
        $input['foto'] = $image->getClientOriginalName();
        $image->move(public_path('reports'),$input['foto']);

        $report = Report::create($input);
        return $report;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return $report;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $input = $request->all();
        $report->update($input);
        return $report;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }

    public function myReport() 
    {
        $myReport = Pembayaran::where('user_id', Auth::user()->id)->where('status', 'success')->with('Package')->get();
        return $myReport;
    }

    public function myReportDetail(Request $request) 
    {
        $myReportDetail = Report::where('id_pembayaran', $request->id_pembayaran)->get();
        return $myReportDetail;
    }

    public function getReportHewan(Request $request) 
    {
        $reportHewan = Report::where('id_pembayaran', $request->id_pembayaran)->where('proses', 'foto_hewan')->where('isReported', '1')->first();
        return $reportHewan;
    }

    public function getReportPenyembelihan(Request $request) 
    {
        $reportPenyembelihan = Report::where('id_pembayaran', $request->id_pembayaran)->where('proses', 'penyembelihan')->where('isReported', '1')->first();
        return $reportPenyembelihan;
    }

    public function getReportPembagian(Request $request) 
    {
        $reportPembagian = Report::where('id_pembayaran', $request->id_pembayaran)->where('proses', 'pembagian')->where('isReported', '1')->first();
        return $reportPembagian;
    }
    
    public function getReportPengiriman(Request $request) 
    {
        $reportPengiriman = Report::where('id_pembayaran', $request->id_pembayaran)->where('proses', 'pengiriman')->where('isReported', '1')->first();
        return $reportPengiriman;
    }

    public function getReportSampai(Request $request) 
    {
        $reportSampai = Report::where('id_pembayaran', $request->id_pembayaran)->where('proses', 'sampai')->where('isReported', '1')->first();
        return $reportSampai;
    }
    
    // public function sendReport(Request $request) 
    // {
    //     $report = Report::where('id', $id)->first();
    //     $report->isReported = true;
    //     $report->save();
    // }
}
