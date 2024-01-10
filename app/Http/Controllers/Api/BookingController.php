<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Booking::all();
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
        $nama_pemilik =$request->get('nama_pemilik'); 
        $no_telfon =$request->get('no_telfon');
        $alamat =$request->get('alamat');
        $nama_hewan =$request->get('nama_hewan');
        $ciri_khusus_hewan =$request->get('ciri_khusus_hewan');
        $umur_kucing =$request->get('umur_kucing');
        $jenis_kucing =$request->get('jenis_kucing');
        $check_in =$request->get('check_in');
        $check_out =$request->get('check_out');
        $berat =$request->get('berat');
        $jenis_kelamin_kucing =$request->get('jenis_kelamin_kucing');
        $treatment_id =$request->get('treatment_id');
        $hotel_id =$request->get('hotel_id');
        Booking::create([
        'nama_pemilik'=>$nama_pemilik,
        'no_telfon'=>$no_telfon,
        'alamat'=>$alamat,
        'nama_hewan'=>$nama_hewan,
        'ciri_khusus_hewan'=>$ciri_khusus_hewan,
        'umur_kucing'=>$umur_kucing,
        'jenis_kucing'=>$jenis_kucing,
        'check_in'=>$check_in,
        'check_out'=>$check_out,
        'berat'=>$berat,
        'jenis_kelamin_kucing'=>$jenis_kelamin_kucing,
        'treatment_id'=>$treatment_id,
        'hotel_id'=>$hotel_id,
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
    public function update(Request $request, Booking $booking)
    {
        $nama_pemilik =$request->get('nama_pemilik'); 
        $no_telfon =$request->get('no_telfon');
        $alamat =$request->get('alamat');
        $nama_hewan =$request->get('nama_hewan');
        $ciri_khusus_hewan =$request->get('ciri_khusus_hewan');
        $umur_kucing =$request->get('umur_kucing');
        $jenis_kucing =$request->get('jenis_kucing');
        $check_in =$request->get('check_in');
        $check_out =$request->get('check_out');
        $berat =$request->get('berat');
        $jenis_kelamin_kucing =$request->get('jenis_kelamin_kucing');
        $treatment_id =$request->get('treatment_id');
        $hotel_id =$request->get('hotel_id');
        $booking->update([
        'nama_pemilik'=>$nama_pemilik,
        'no_telfon'=>$no_telfon,
        'alamat'=>$alamat,
        'nama_hewan'=>$nama_hewan,
        'ciri_khusus_hewan'=>$ciri_khusus_hewan,
        'umur_kucing'=>$umur_kucing,
        'jenis_kucing'=>$jenis_kucing,
        'check_in'=>$check_in,
        'check_out'=>$check_out,
        'berat'=>$berat,
        'jenis_kelamin_kucing'=>$jenis_kelamin_kucing,
        'treatment_id'=>$treatment_id,
        'hotel_id'=>$hotel_id,
        ]);
        return response()->json(['sukses update data'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['sukses delete data'], 200);
    }
}
