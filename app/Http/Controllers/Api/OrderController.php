<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReqStoreOrder;
use App\Http\Requests\ReqUpdateOrder;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::select('order.id as order_id', 'booking.id as booking_id', 'booking.*','total_harga')
            ->join('booking', 'booking.id', '=', 'order.booking_id')
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
    public function store(ReqStoreOrder $request)
    {
        $result = Order::create($request->all());

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
    public function update(ReqUpdateOrder $request, Order $order)
    {
        $result = $order->update($request->all());

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
    public function destroy(Order $order)
    {
        $result = $order->delete();

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
