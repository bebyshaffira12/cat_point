<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Invoice::select('booking.*','status_pembayaran')
            ->join('order', 'order.id', '=', 'invoice.order_id')
            ->join('booking', 'booking.id', '=', 'invoice.booking_id')
            ->get();
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
        $status_pembayaran =$request->get('status_pembayaran'); 
        $booking_id =$request->get('booking_id');
        $order_id =$request->get('order_id');
        Invoice::create([
        'status_pembayaran'=>$status_pembayaran,
        'booking_id'=>$booking_id,
        'order_id'=>$order_id,
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
    public function update(Request $request, Invoice $invoice)
    {
        $status_pembayaran =$request->get('status_pembayaran'); 
        $booking_id =$request->get('booking_id');
        $order_id =$request->get('order_id');
        $invoice->update([
        'status_pembayaran'=>$status_pembayaran,
        'booking_id'=>$booking_id,
        'order_id'=>$order_id,
        ]);
        return response()->json(['sukses update data'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(['sukses delete data'], 200);
    }
}
