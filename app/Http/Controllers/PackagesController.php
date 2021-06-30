<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Packages::all();
    }

    public function getPackageByType(Request $request) {
        return Packages::where('tipe', $request->tipe)->orderBy('berat', 'asc')->get();
    }

    // public function package_kambing_jantan() 
    // {
    //     return Package::where('tipe', 'kambing_jantan')->get();
    // }

    // public function package_sapi() 
    // {
    //     return Package::where('tipe', 'sapi')->get();
    // }

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
     * @param  \App\Models\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function show(Packages $package)
    {
        return $package;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function edit(Packages $packages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Packages $packages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Packages $packages)
    {
        //
    }

    public function getWeightRange() {
        $kambing_jantan = Packages::where('tipe', 'kambing_jantan');
        $berat_kambing_jantan = [
            'min' => $kambing_jantan->min('berat'),
            'max' => $kambing_jantan->max('berat'),
        ];

        $sapi = Packages::where('tipe', 'sapi');
        if ($sapi->min('berat') == $sapi->max('berat')) {
            $berat_sapi = $sapi->min('berat');
        } else {
            $berat_sapi = [
                'min' => $sapi->min('berat'),
                'max' => $sapi->max('berat'),
            ];
        }

        return response()->json([
            'kambing_jantan' => $berat_kambing_jantan,
            'sapi' => $berat_sapi,
        ]);
        // $minBerat = Packages::where('berat', $request->type)->min('berat');
        // $maxBerat = Packages::where('berat', $request->type)->max('berat');
        // return $weightRange = [
        //     'min' => $minBerat,
        //     'max' => $maxBerat,
        // ];
    }

    public function getPriceRange(Request $request) {
        $minPrice = Packages::where('tipe', $request->type)->min('harga');
        $maxPrice = Packages::where('tipe', $request->type)->max('harga');
        return $priceRange = [
            'min' => $minPrice,
            'max' => $maxPrice,
        ];
    }
}
