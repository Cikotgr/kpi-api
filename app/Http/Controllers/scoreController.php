<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class scoreController extends Controller
{
    public function index() : JsonResponse {

        try{
            $scors = Answer::select('idResponden', DB::raw('SUM(totalPoin) as poinAkhir'))->groupBy('idResponden')->get();

            return response()->json([
                "message" => "success",
                "data" => $scors
            ],Response::HTTP_OK);

        }catch(\Exception $e){
            return response()->json([
                "message" => "failed",
                "error" => $e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

    public function show($id) : JsonResponse {

        try{
            $scors = Answer::select('idResponden', DB::raw('SUM(totalPoin) as poinAkhir'))->where('idResponden', $id)->groupBy('idResponden')->get();

            return response()->json([
                "message" => "success",
                "data" => $scors
            ],Response::HTTP_OK);
        }catch(\Exception $e){
            return response()->json([
                "message" => "failed",
                "error" => $e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}
