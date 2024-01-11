<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReqStoreTestimoni;
use App\Http\Requests\ReqUpdateTestimoni;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Testimoni::all();
        return $this->createResponse(
            true,
            'success',
            $data,
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
    public function store(ReqStoreTestimoni $request)
    {
        $result = Testimoni::create($request->all());

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
    public function update(ReqUpdateTestimoni $request, Testimoni $testimoni)
    {
        $result = $testimoni->update($request->all());

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
    public function destroy(Testimoni $testimoni)
    {
        $result = $testimoni->delete();
        
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
