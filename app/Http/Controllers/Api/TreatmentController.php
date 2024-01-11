<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReqStoreTreatment;
use App\Http\Requests\ReqUpdateTreatment;
use App\Models\Treatment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Treatment::all();
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
    public function store(ReqStoreTreatment $request)
    {
        $gambar = $request->file('gambar');
        $fileLocation = null;

        if (!empty($gambar)) {
            $filename = md5($gambar . microtime()) . '_' . Str::random(30) . '.' . $gambar->extension();
            $fileLocation = $gambar->storeAs('uploads', $filename, 'uploads');
        }

        $result = Treatment::create([
            'paket'         => $request->get('paket'),
            'harga'         => $request->get('harga'),
            'deskripsi'     => $request->get('deskripsi'),
            'gambar'        => $fileLocation ? 'storage/' . $fileLocation : null,
        ]);

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
    public function update(ReqUpdateTreatment $request, Treatment $treatment)
    {
        $gambar = $request->file('gambar');
        $fileLocation = null;

        if (!empty($gambar)) {
            $filename = md5($gambar . microtime()) . '_' . Str::random(30) . '.' . $gambar->extension();
            $fileLocation = $gambar->storeAs('uploads', $filename, 'uploads');
        }

        if ($fileLocation) {
            if ($treatment->gambar) {
                $storage = Storage::disk('uploads');
                $picture = str_replace('storage/', '', $treatment->gambar);
                if ($storage->exists($picture)) {
                    $storage->delete($picture);
                }
            }

            $result = $treatment->update([
                'paket'      => $request->get('paket'),
                'harga'             => $request->get('harga'),
                'deskripsi'         => $request->get('deskripsi'),
                'gambar'            => 'storage/' . $fileLocation,
            ]);
        } else {
            $result = $treatment->update([
                'paket'      => $request->get('paket'),
                'harga'             => $request->get('harga'),
                'deskripsi'         => $request->get('deskripsi'),
            ]);
        }

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
    public function destroy(Treatment $treatment)
    {
        if ($treatment->gambar) {
            $storage = Storage::disk('uploads');
            $picture = str_replace('storage/', '', $treatment->gambar);
            if ($storage->exists($picture)) {
                $storage->delete($picture);
            }
        }

        $result = $treatment->delete();

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
