<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        try{
            //get data users
            $users = User::role('staf')->get();

            //null-check
            if(count($users) > 0){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data user berhasil diambil!',
                    'questions-data' => $users
                ], 200, [], JSON_PRETTY_PRINT);
            }else{ //return gagal kalo kosong
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data user kosong',
                ], 404, [], JSON_PRETTY_PRINT);
            }

        }catch(\Exception $e){
            //kalau ada error dari server
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal diambil karena error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function ob_index(){
        try{
            //get data users
            $users = User::role('ob')->get();

            //null-check
            if(count($users) > 0){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data OB berhasil diambil!',
                    'questions-data' => $users
                ], 200, [], JSON_PRETTY_PRINT);
            }else{ //return gagal kalo kosong
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data user kosong',
                ], 404, [], JSON_PRETTY_PRINT);
            }

        }catch(\Exception $e){
            //kalau ada error dari server
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal diambil karena error: ' . $e->getMessage()
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}
