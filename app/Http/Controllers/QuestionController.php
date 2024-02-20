<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            //ambil data pertanyaan dari tabel Questions
            $questions = Question::all();
            
            //null-check
            if(count($questions)>0){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil diambil!',
                    'questions-data' => $questions
                ], 200, [], JSON_PRETTY_PRINT);
            } else {
                //kalau data kosong atau nol
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pertanyaan tidak tersedia'
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // validasi input
            $request->validate([
                'isiPertanyaan' => 'required|string'
            ]);

            // create data pertanyaan
            $question = Question::create([
                'isiPertanyaan' => $request->input('isiPertanyaan')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data pertanyaan berhasil ditambahkan',
                'question' => $question
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data pertanyaan: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
