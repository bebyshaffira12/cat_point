<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ReqStoreService;
use App\Http\Requests\ReqUpdateService;
use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Service::all();
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
    public function store(ReqStoreService $request)
    {
        $gambar = $request->file('gambar');
        $fileLocation = null;

        if (!empty($gambar)) {
            $filename = md5($gambar . microtime()) . '_' . Str::random(30) . '.' . $gambar->extension();
            $fileLocation = $gambar->storeAs('uploads', $filename, 'uploads');
        }

        $result = Service::create([
            'paket_fluffy'      => $request->get('paket_fluffy'),
            'harga'             => $request->get('harga'),
            'deskripsi'         => $request->get('deskripsi'),
            'gambar'            => $fileLocation ? '/storage'. $fileLocation : null,
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
    public function update(ReqUpdateService $request, Service $service)
    {
        $gambar = $request->file('gambar');
        $fileLocation = null;

        if (!empty($gambar)) {
            $filename = md5($gambar . microtime()) . '_' . Str::random(30) . '.' . $gambar->extension();
            $fileLocation = $gambar->storeAs('uploads', $filename, 'uploads');
        }

        if ($fileLocation) {
            if ($service->gambar) {
                $storage = Storage::disk('uploads');
                $picture = str_replace('storage/', '', $service->gambar);
                if ($storage->exists($picture)) {
                    $storage->delete($picture);
                }
            }

            $result = $service->update([
                'paket_fluffy'      => $request->get('paket_fluffy'),
                'harga'             => $request->get('harga'),
                'deskripsi'         => $request->get('deskripsi'),
                'gambar'            => 'storage/' . $fileLocation,
            ]);
        } else {
            $result = $service->update([
                'paket_fluffy'      => $request->get('paket_fluffy'),
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
    public function destroy(Service $service)
    {
        if ($service->gambar) {
            $storage = Storage::disk('uploads');
            $picture = str_replace('storage/', '', $service->gambar);
            if ($storage->exists($picture)) {
                $storage->delete($picture);
            }
        }

        $result = $service->delete();

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
