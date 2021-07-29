<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\Login;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));

        $register = Login::create([
            'username' => $username,
            'password' => $password
        ]);

        if ($register) {
            return response()->json([
                'success'=> true,
                'message'=> "register success",
                'data'=> $register
            ],201);
        }
        else {
            return response()->json([
                'success'=> false,
                'message'=> "register failed",
                'data'=> ''
            ],400);
        }
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = Login::where('username', $username)->first();

        if(!$user){
            return response()->json([
                'success'=> false,
                'message'=> "user not found",
                'data'=> ''
            ],400);
        }

        if (Hash::check($password, $user->password)){
            return response()->json([
                'success'=> true,
                'message'=> "login success",
                'data'=> $user
            ],201);
        }
        else {
            return response()->json([
                'success'=> false,
                'message'=> "login failed",
                'data'=> ''
            ],400);
        }
    }
}
