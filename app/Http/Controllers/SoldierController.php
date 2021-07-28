<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\Soldier;

class SoldierController extends Controller
{
    public function insert(Request $request)
    {
        $id_soldier = $request->input('id_soldier');
        $nama_soldier = $request->input('nama_soldier');

        $insert = Soldier::create([
            'id_soldier' => $id_soldier,
            'nama_soldier' => $nama_soldier
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
        $id_soldier = $request->input('id_soldier');
        $nama_soldier = $request->input('nama_soldier');

        $data_soldier = Soldier::all();
        $count_data = count($data_soldier);

        if ($count_data > 0) {
            return response()->json([
                'success'=> true,
                'message'=> "Get Data success",
                'data'=> $data_soldier
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
