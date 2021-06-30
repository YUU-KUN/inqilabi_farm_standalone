<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pembayaran::with('Package')->get();
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
        if (!$input['isAgree']) {
            return 'Mohon setujui syarat dan ketentuan';
        }
        $input['user_id'] = Auth::user()->id;

        $image = $request->file('bukti_transfer');
        $input['bukti_transfer'] = $image->getClientOriginalName();
        $image->move(public_path('bukti_transfer'), $input['bukti_transfer']);

        $pembayaran = Pembayaran::create($input);

        if ($pembayaran->proses == 'dikirim') {
            $input['id_pembayaran'] = $pembayaran->id;
            Pengiriman::create($input); //create pengiriman
        }
        return $pembayaran;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->with('Package')->first();
        return $pembayaran;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $input = $request->all();
        $pembayaran->update($input);
        return $pembayaran;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }

    public function uploadBuktiTransfer(Request $request) {
        $input = $request->all();
        $pembayaran = Pembayaran::where('user_id', Auth::user()->id)->where('id', $input['package_id'])->latest()->first();

        $image = $request->file('bukti_transfer');
        $input['bukti_transfer'] = $image->getClientOriginalName();
        $image->move(public_path('bukti_transfer'),$input['bukti_transfer']);
        
        $pembayaran->update($input);
        return $pembayaran;
    }

    public function getPembayaranUser() {
        $pembayaran = Pembayaran::where('user_id', Auth::user()->id)->with('Package')->get();
        return response()->json([
            'message' => 'Berhasil mendapatkan data pembayaran'.Auth::user()->name,
            'data' => $pembayaran,
        ]);
    }

    public function approve(Request $request) {
        $pembayaran = Pembayaran::where('id', $request->id)->first();
        $pembayaran->status = 'success';
        $pembayaran->save();
    }

    public function reject(Request $request) {
        $pembayaran = Pembayaran::where('id', $request->id)->first();
        $pembayaran->status = 'failed';
        $pembayaran->save();
    }
}
