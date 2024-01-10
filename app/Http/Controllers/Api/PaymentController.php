<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as RoutingController;

class PaymentController extends RoutingController
{
    function book(Request $request) {
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
        $booking =Booking::create([
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
        $treatment = Treatment::find($treatment_id)->firstOrFail();
        $hotel = Hotel::find($hotel_id)->firstOrFail();

        $total_harga = $treatment->harga + $hotel->harga;
        $order=Order::create([
        'booking_id'=>$booking->id,
        'total_harga'=>$total_harga,
        ]);
        $data= [
            'order_id'=> $order->id, 
            'treatment'=> $treatment, 
            'service'=> $hotel,
            'total_pembayaran'=> $total_harga
        ];

        return response()->json($data, 200);

    }
    function generateqr(Request $request){
        $midTransRequest = [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id' => 'order' . $request->get('order_id'),
                'gross_amount' => $request->get('total_pembayaran'),
            ],
            'qris' => [
                'acquirer' => 'gopay'
            ]
        ];

        Log::info(['request' => $midTransRequest]);

        $response = Http::withBasicAuth(
            'SB-Mid-server-64mtPAJYSuZ7Po9PfAZA6hv1',''
        )
        ->withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Basic 64mtPAJYSuZ7Po9PfAZA6hv1',
            'content-type' => 'application/json',
        ])
        ->post('https://api.sandbox.midtrans.com/v2/charge', $midTransRequest);

        Log::info($response->body());

        if ($response->successful()) {
            Log::info('success');
            Log::info(['response' => $response->json()]);
            return $response->json();
            
        } else if ($response->serverError()) {
            Log::info('Server error');
            Log::info(['exception' => $response->throw()]);

            return response()->json(['message' => 'internal server error'], 500);
        }
        
    }    
        function checkstatus() {
            
        }
}
