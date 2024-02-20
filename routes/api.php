<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/all-questions', [QuestionController::class, 'index']);

    Route::middleware(['role:admin'])->group(function () {
        Route::post('/add-question', [QuestionController::class, 'store']);
    });

    Route::middleware(['role:ob'])->group(function () {
        Route::resource("answer", AnswerController::class);
    });
});

Route::get('/all-users', [UserController::class, 'index']);
Route::get('/all-ob', [UserController::class, 'ob_index']);

require __DIR__.'/auth-api.php';
