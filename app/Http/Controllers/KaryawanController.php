<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use Symfony\Component\HttpFoundation\Response;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        $response = [
            'meta' => [
                'status' => 'success',
                'code' => 200,
                'message' => 'Data Karyawan obtained',
            ],
            'data' => $karyawans,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryawanRequest $request)
    {
        $request->validated();

        $newKaryawan = Karyawan::create($request);

        $karyawan = new Karyawan();
        $karyawan->nomor_induk = 'IP06'.str_pad($newKaryawan->id, 3, "0", STR_PAD_LEFT);
        $karyawan->save();

        $response = [
            'meta' => [
                'status' => 'success',
                'code' => 200,
                'message' => 'Data Karyawan added',
            ],
            'data' => $karyawan,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryawanRequest $request, Karyawan $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //
    }
}
