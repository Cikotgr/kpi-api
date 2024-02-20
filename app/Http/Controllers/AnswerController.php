<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'idUser' => $request->idUser,
            'idResponden' => $request->idResponden,
            'questionAnswers' => json_encode($dataToStore),
            'totalPoin' => $counter
        ]);

        // return redirect()->back()->with('success', 'Data berhasil disimpan.');
        return response()->json([
            'Answer' => $answer
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        $answer = Answer::findOrFail($answer->id);

        return response()->json([
            'Answer' => $answer
        ]);
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

    public function resultCount(Answer $answer)
    {
        $answer = Answer::findOrFail($answer->id);

        return response()->json([
            "Answer" => $answer
        ]);
    }
}
