<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;
use GuzzleHttp\Client;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sertifikat::with('Pembayaran')->with('Pembayaran.package')->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sertifikat::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Sertifikat::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendWhatsApp(Request $request)
    {
        $client = new Client();
        $input = $request->all();
        // $res = $client->post(
        //     'localhost:3000/api/sendMediaFromUrl',
        //     [
        //         'form_params' => [
        //             'apiKey' => env('WHAPI_API_KEY'),
        //             'phone' => $input['phone'],
        //             'file_name' => $input['url_file'],
        //             'as_document' => 0
        //         ]
        //     ]
        // );
        // $res = $client->post(
        //     'halo',
        //     [
        //         'form_params' => [
        //             'apiKey' => env('WHAPI_API_KEY'),
        //             'phone' => $input['phone'],
        //             'message' => $input['message'],
        //         ]
        //     ]
        // );
        // return $res;
        
        $res = $client->post('https://www.inqilabifarm.com/api/sendMessage', [
            'form_params' => [
                'phone' => '082244627112',
                'secret' => 'test_secret',
                'apiKey' => 'e2a75df5ce2bbbc487a4fe2ffa50a561'
            ]
        ]);
        return $res;
    }
}
