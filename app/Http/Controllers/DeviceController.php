<?php

namespace App\Http\Controllers;

use App\Model\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\Soldier;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function insert(Request $request)
    {
        $id_device = $request->input('id_device');
        $nama_device = $request->input('nama_device');
        $id_soldier = $request->input('id_soldier');

        $insert = Device::create([
            'id_device' => $id_device,
            'nama_device' => $nama_device,
            'id_soldier' => $id_soldier
        ]);

        if ($insert) {
            return response()->json([
                'success'=> true,
                'message'=> "insert success",
                'data'=> $insert
            ],201);
        }
        else {
            return response()->json([
                'success'=> false,
                'message'=> "insert failed",
                'data'=> ''
            ],400);
        }
    }

    public function getData(Request $request)
    {

        $data_device = DB::table('devices')
            ->join('soldiers', 'devices.id_soldier', '=', 'soldiers.id_soldier')
            ->select('devices.*', 'soldiers.nama_soldier','soldiers.nama_team')
            ->get();


        $count_data = count($data_device);

        if ($count_data > 0) {
            return response()->json([
                'success'=> true,
                'message'=> "Get Data success",
                'data'=> $data_device
            ],201);
        }
        else {
            return response()->json([
                'success'=> false,
                'message'=> "No Data Soldier",
                'data'=> ''
            ],400);
        }
    }
}
