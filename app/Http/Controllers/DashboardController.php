<?php

namespace App\Http\Controllers;

use App\Model\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\Soldier;
use App\Model\Dashboard;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function getData(Request $request)
    {

        // $id_device = DB::table('dashboards')
        //     ->select(DB::raw('MAX(dashboards.id) AS id'))
        //     ->groupBy('dashboards.id_device')
        //     ->get();

        // $data_device = DB::table('dashboards')
        //     ->select([DB::raw('MAX(dashboards.id) AS id'),'dashboards.id_device','devices.nama_device','soldiers.id_soldier','soldiers.nama_soldier',
        //             'dashboards.temperature','dashboards.pulse','dashboards.oxygen','dashboards.direction','dashboards.latitude','dashboards.longitude'])
        //     ->join('devices', 'devices.id_device', '=', 'dashboards.id_device')
        //     ->join('soldiers', 'devices.id_soldier', '=', 'devices.id_soldier')
        //     ->groupBy('dashboards.id_device')
        //     ->get();

        $data_device = DB::table('dashboards')
            ->select(['dashboards.id','dashboards.id_device','devices.nama_device','soldiers.id_soldier','soldiers.nama_soldier',
                    'dashboards.temperature','dashboards.pulse','dashboards.oxygen','dashboards.bloodPressure','dashboards.respiration',
                    'dashboards.direction','dashboards.latitude','dashboards.longitude'])
            ->join('devices', 'devices.id_device', '=', 'dashboards.id_device')
            ->join('soldiers', 'devices.id_soldier', '=', 'soldiers.id_soldier')
            ->whereIn('dashboards.id', function($query){
                $query->select(DB::raw('MAX(dashboards.id) AS id'))
                    ->from(with(new Dashboard)->getTable())
                    ->groupBy('dashboards.id_device')
                    ->get();
            })
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

    public function getDataById(Request $request,$id)
    {

        $data_device = DB::table('dashboards')
            ->select(['dashboards.id','dashboards.id_device','devices.nama_device','soldiers.id_soldier','soldiers.nama_soldier',
                    'dashboards.temperature','dashboards.pulse','dashboards.oxygen','dashboards.bloodPressure','dashboards.respiration',
                    'dashboards.direction','dashboards.latitude','dashboards.longitude'])
            ->join('devices', 'devices.id_device', '=', 'dashboards.id_device')
            ->join('soldiers', 'devices.id_soldier', '=', 'soldiers.id_soldier')
            ->where('dashboards.id_device',$id)
            ->limit(1)
            ->orderByDesc('dashboards.id')
            ->get();

        $count_data = count($data_device);

        if ($count_data > 0) {
            return response()->json([
                'success'=> true,
                'message'=> "Get Data success",
                'data'=> $data_device,
                'id_device'=> $id
            ],201);
        }
        else {
            return response()->json([
                'success'=> false,
                'message'=> "No Data Dashboard",
                'data'=> ''
            ],400);
        }
    }

    public function getDataChartById(Request $request,$id)
    {

        $data_device = DB::table('dashboards')
            ->select(['dashboards.id','dashboards.id_device',
                    'dashboards.temperature','dashboards.pulse','dashboards.oxygen','dashboards.bloodPressure','dashboards.respiration'])
            ->join('devices', 'devices.id_device', '=', 'dashboards.id_device')
            ->join('soldiers', 'devices.id_soldier', '=', 'soldiers.id_soldier')
            ->where('dashboards.id_device',$id)
            ->limit(5)
            ->orderByDesc('dashboards.id')
            ->get();

        $count_data = count($data_device);

        if ($count_data > 0) {
            return response()->json([
                'success'=> true,
                'message'=> "Get Data success",
                'data'=> $data_device,
                'id_device'=> $id
            ],201);
        }
        else {
            return response()->json([
                'success'=> false,
                'message'=> "No Data Dashboard",
                'data'=> ''
            ],400);
        }
    }

    public function getDataMap(Request $request)
    {

        $data_device = DB::table('dashboards')
            ->select(['dashboards.id','dashboards.id_device','devices.nama_device','soldiers.id_soldier','soldiers.nama_soldier',
                    'dashboards.direction','dashboards.latitude','dashboards.longitude'])
            ->join('devices', 'devices.id_device', '=', 'dashboards.id_device')
            ->join('soldiers', 'devices.id_soldier', '=', 'soldiers.id_soldier')
            ->whereIn('dashboards.id', function($query){
                $query->select(DB::raw('MAX(dashboards.id) AS id'))
                    ->from(with(new Dashboard)->getTable())
                    ->groupBy('dashboards.id_device')
                    ->get();
            })
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
                'message'=> "No Data Dashboard",
                'data'=> ''
            ],400);
        }
    }


    public function insert(Request $request)
    {
        $id_device = $request->input('id_device');
        $temperature = $request->input('temperature');
        $pulse = $request->input('pulse');
        $oxygen = $request->input('oxygen');
        $bloodPressure = $request->input('bloodPressure');
        $respiration = $request->input('respiration');
        $direction = $request->input('direction');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $insert = Dashboard::create([
            'id_device' => $id_device,
            'temperature' => $temperature,
            'pulse' => $pulse,
            'oxygen' => $oxygen,
            'bloodPressure' => $bloodPressure,
            'respiration' => $respiration,
            'direction' => $direction,
            'latitude' => $latitude,
            'longitude' => $longitude,
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
}
