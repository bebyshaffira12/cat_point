<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReqStoreInvoice;
use App\Http\Requests\ReqUpdateInvoice;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Invoice::select('invoice.id as invoice_id', 'booking.*', 'status_pembayaran')
            ->join('order', 'order.id', '=', 'invoice.order_id')
            ->join('booking', 'booking.id', '=', 'invoice.booking_id')
            ->get();
        return $this->createResponse(
            true,
            'success',
            $data->makeHidden(['id']),
            200
        );
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
    public function store(ReqStoreInvoice $request)
    {
        $result = Invoice::create($request->all());

        if ($result) {
            $this->createResponse(
                true,
                'success',
                $result,
                200
            );
        }

        return $this->createResponse(
            false,
            'error',
            null,
            500
        );
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
    public function update(ReqUpdateInvoice $request, Invoice $invoice)
    {
        $result = $invoice->update($request->all());

        if ($result) {
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
            null,
            500
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $result = $invoice->delete();

        if ($result) {
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
            null,
            500
        );
    }
}
