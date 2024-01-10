<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Controller as RoutingController;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hotel:: all();

    return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paket_fluffy =$request->get('paket_fluffy'); 
        $harga =$request->get('harga');
        $deskripsi =$request->get('deskripsi');
        $gambar =$request->get('gambar');
        Hotel::create([
        'paket_fluffy'=>$paket_fluffy,
        'harga'=>$harga,
        'deskripsi'=>$deskripsi,
        'gambar'=>$gambar,
        ]);
        return response()->json(['sukses create data'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, Hotel $hotel)
    {
        $paket_fluffy =$request->get('paket_fluffy'); 
        $harga =$request->get('harga');
        $deskripsi =$request->get('deskripsi');
        $gambar =$request->get('gambar');
        $hotel->update([
        'paket_fluffy'=>$paket_fluffy,
        'harga'=>$harga,
        'deskripsi'=>$deskripsi,
        'gambar'=>$gambar,
        ]);
        return response()->json(['sukses update data'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json(['sukses delete data'], 200);
    }
}
