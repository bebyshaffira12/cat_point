<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class UserController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Treatment:: all();

    return response()->json($data, 200);
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
        $paket =$request->get('paket'); 
        $harga =$request->get('harga');
        $deskripsi =$request->get('deskripsi');
        $gambar =$request->get('gambar');
        Treatment::create([
        'paket'=>$paket,
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
    public function update(Request $request, Treatment $treatment)
    {
        $paket =$request->get('paket'); 
        $harga =$request->get('harga');
        $deskripsi =$request->get('deskripsi');
        $gambar =$request->get('gambar');
        $treatment->update([
        'paket'=>$paket,
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
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return response()->json(['sukses delete data'], 200);
    }
}
