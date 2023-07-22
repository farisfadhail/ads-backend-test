<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Http\Requests\StoreCutiRequest;
use App\Http\Requests\UpdateCutiRequest;
use App\Models\Karyawan;
use Symfony\Component\HttpFoundation\Response;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cutis = Cuti::select('nomor_induk', Cuti::raw('YEAR(tanggal_cuti) as year'), Cuti::raw('SUM(lama_cuti) as total_cuti'))
                ->groupBy('nomor_induk', 'year')
                ->get();

        $datas = [];

        foreach ($cutis as $cuti) {
            $karyawan = Karyawan::where('nomor_induk', $cuti->nomor_induk)->get();

            $data = [
                'nomor_induk' => $cuti->nomor_induk,
                'nama' => $karyawan[0]->nama,
                'sisa_cuti' => 12 - $cuti->total_cuti,
                //'tahun' => $cuti->year
            ];

            array_push($datas, $data);
        }

        $response = [
            'meta' => [
                'status' => 'success',
                'code' => 200,
                'message' => 'Data Cuti Obtained',
            ],
            'data' => $datas,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCutiRequest $request)
    {
        $request->validated();

        $data = [
            "nomor_induk" => $request->nomor_induk,
            "tanggal_cuti" => $request->tanggal_cuti,
            "lama_cuti" => $request->lama_cuti,
            "keterangan" => $request->keterangan,
        ];

        $cuti = Cuti::create($data);

        $cuti->save();

        $response = [
            'meta' => [
                'status' => 'success',
                'code' => 200,
                'message' => 'Data Cuti Added',
            ],
            'data' => $cuti,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCutiRequest $request, Cuti $cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuti $cuti)
    {
        //
    }
}
