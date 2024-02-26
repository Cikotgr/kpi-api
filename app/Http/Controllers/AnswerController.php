<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Rules\idRespondenRole;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $answers = Answer::all();

            return response()->json([
                'Answers' => $answers
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "idResponden" => ["required","integer",new idRespondenRole],
                "questionAnswers" => "required",
                "questionAnswers.*.question_id" => "integer|exists:questions,id",
                "questionAnswers.*.answer" => "integer|size:5"
            ]);

            $dataToStore = [];

            $counter = 0;

            foreach ($request->questionAnswers as $data) {

                switch ($data['answer']) {
                    case 5:
                        $poin = 2;
                        break;
                    case 4:
                        $poin = 1;
                        break;
                    case 3:
                        $poin = 0;
                        break;
                    case 2:
                        $poin = -1;
                        break;
                    case 1:
                        $poin = -2;
                        break;
                    default:
                        $poin = 0;
                }

                $dataToStore[] = [
                    'question_id' => $data['question_id'],
                    'answer' => $data['answer'],
                ];

                $counter =+ $poin;
            }

            $answer = Answer::create([
                'idUser' => Auth::id(),
                'idResponden' => $request->idResponden,
                'questionAnswers' => json_encode($dataToStore),
                'totalPoin' => $counter
            ]);

            return response()->json([
                'Answer' => $answer
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan data pertanyaan: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        try {
            $answer = Answer::findOrFail($answer->id);

            $user = User::findOrFail($answer->idUser);

            $responden = User::findOrFail($answer->idResponden);

            return response()->json([
                'User' => $user,
                'Responden' => $responden,
                'Answer' => $answer
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
