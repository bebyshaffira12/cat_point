<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReqCheckStatus;
use App\Http\Requests\ReqGenerateQr;
use App\Models\Booking;
use App\Models\Invoice;
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

        $treatment = Treatment::where('id', '=', $treatment_id)->firstOrFail();
        $service = Service::where('id', '=', $service_id)->firstOrFail();

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
        $order = Order::where('id', '=', $request->get('order_id'))->firstOrFail();
        $booking = Booking::where('id', '=', $order->booking_id)->firstOrFail();
        $treatment = Treatment::where('id', '=', $booking->treatment_id)->firstOrFail();
        $service = Service::where('id', '=', $booking->service_id)->firstOrFail();

        if ($order) { 
            $midTransRequest = [
                'payment_type' => 'qris',
                'transaction_details' => [
                    'order_id' => md5('order-' . $request->get('order_id') . '-' . microtime()),
                    'gross_amount' => $order->total_harga,
                ],
                'item_details' => [
                    [
                        'name' => $service->paket_fluffy,
                        'price' => $service->harga,
                        'quantity' => 1,
                    ],
                    [
                        'name' => $treatment->paket,
                        'price' => $treatment->harga,
                        'quantity' => 1,
                    ],
                ],
                'customer_details' => [
                    'nama_pemilik'          => $booking->nama_pemilik,
                    'no_telfon'             => $booking->no_telfon,
                    'alamat'                => $booking->alamat,
                    'nama_hewan'            => $booking->nama_hewan,
                    'ciri_khusus_hewan'     => $booking->ciri_khusus_hewan,
                    'umur_kucing'           => $booking->umur_kucing,
                    'jenis_kucing'          => $booking->jenis_kucing,
                    'check_in'              => $booking->check_in,
                    'check_out'             => $booking->check_out,
                    'berat'                 => $booking->berat,
                    'jenis_kelamin_kucing'  => $booking->jenis_kelamin_kucing,
                    'treatment_id'          => $booking->treatment_id,
                    'service_id'            => $booking->service_id,
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


            if ($response->status() >= 200 && $response->status() <= 205) {
                
                $invoice = Invoice::create([
                    'status_pembayaran' => 'pending',
                    'order_id' => $order->id,
                    'booking_id' => $booking->id,
                ]);

                $result = array_merge($response->json(), ['invoice_id' => $invoice->id]);

                return $this->createResponse(
                    true,
                    'success',
                    $result,
                    200
                );
            }

            return $this->createResponse(
                false,
                'failed',
                $response->json(),
                400
            );
        }

        return $this->createResponse(
            false,
            'Order Not Found',
            null,
            400
        );
    }

    function checkstatus(ReqCheckStatus $request)
    {
        $invoice = Invoice::with(['booking' => ['treatment', 'service']])->where('id', '=', $request->get('invoice_id'))->firstOrFail();

        if ($request->get('order_id')) {
            $response = Http::withBasicAuth(
                'SB-Mid-server-64mtPAJYSuZ7Po9PfAZA6hv1',
                ''
            )
                ->withHeaders([
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])
                ->get('https://api.sandbox.midtrans.com/v2/'. $request->get('order_id') . '/status');

            if ($response->successful() == 200) {
                if ($response->json('status_code') == 404) {
                    return $this->createResponse(
                        false,
                        'Not Found',
                        $response->json(),
                        404
                    );
                } 

                if ($response->json('transaction_status') != 'pending') {
                    $invoice->update([
                        'status_pembayaran' => $response->json('transaction_status')
                    ]);
                }

                return $this->createResponse(
                    true,
                    'success',
                    array_merge($response->json(), ['invoice' => $invoice ]),
                    200
                );
            }

            return $this->createResponse(
                false,
                'failed',
                $response->json(),
                400
            );
        }

        return $this->createResponse(
            false,
            'Order Not Found',
            null,
            400
        );
    }

    function cancel(ReqCheckStatus $request) {
        $invoice = Invoice::with(['booking' => ['treatment', 'service']])->where('id', '=', $request->get('invoice_id'))->firstOrFail();

        if ($request->get('order_id')) {
            $response = Http::withBasicAuth(
                'SB-Mid-server-64mtPAJYSuZ7Po9PfAZA6hv1',
                ''
            )
                ->withHeaders([
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])
                ->get('https://api.sandbox.midtrans.com/v2/' . $request->get('order_id') . '/status');

            if ($response->successful() == 200) {
                if ($response->json('status_code') == 404) {
                    return $this->createResponse(
                        false,
                        'Not Found',
                        $response->json(),
                        404
                    );
                }

                if ($response->json('transaction_status') != 'pending') {
                    $invoice->update([
                        'status_pembayaran' => $response->json('transaction_status')
                    ]);
                }

                return $this->createResponse(
                    true,
                    'success',
                    array_merge($response->json(), ['invoice' => $invoice]),
                    200
                );
            }

            return $this->createResponse(
                false,
                'failed',
                $response->json(),
                400
            );
        }

        return $this->createResponse(
            false,
            'Order Not Found',
            null,
            400
        );
    }
}
