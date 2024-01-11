<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReqGenerateQr;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    function book(Request $request)
    {
        $treatment_id = $request->get('treatment_id');
        $service_id = $request->get('service_id');

        $booking = Booking::create($request->all());

        $treatment = Treatment::find($treatment_id)->firstOrFail();
        $service = Service::find($service_id)->firstOrFail();

        $total_harga = ($treatment->harga ?? 0) + ($service->harga ?? 0);

        $order = Order::create([
            'booking_id' => $booking->id,
            'total_harga' => $total_harga,
        ]);

        $data = [
            'order_id' => $order->id,
            'treatment' => $treatment,
            'service' => $service,
            'total_pembayaran' => $total_harga
        ];

        return $this->createResponse(
            true,
            'success',
            $data,
            200
        );
    }

    function generateqr(ReqGenerateQr $request)
    {
        $order = Order::find($request->get('order_id'))->firstOrFail();

        if ($order) {
            $midTransRequest = [
                'payment_type' => 'qris',
                'transaction_details' => [
                    'order_id' => 'order' . $order->id,
                    'gross_amount' => $order->total_harga,
                ],
                'qris' => [
                    'acquirer' => 'gopay'
                ]
            ];

            $response = Http::withBasicAuth(
                'SB-Mid-server-64mtPAJYSuZ7Po9PfAZA6hv1',
                ''
            )
                ->withHeaders([
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])
                ->post('https://api.sandbox.midtrans.com/v2/charge', $midTransRequest);


            if ($response->successful()) {
                return $this->createResponse(
                    true,
                    'success',
                    $response->json(),
                    200
                );
            }

            return $this->createResponse(
                false,
                'failed',
                null,
                500
            );
        }

        return $this->createResponse(
            false,
            'Order Not Found',
            null,
            400
        );
    }

    function checkstatus()
    {
    }
}
