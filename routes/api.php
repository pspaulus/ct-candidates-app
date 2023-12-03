<?php

use App\Context\Task\UI\Controller\API\CreateTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/task', [CreateTaskController::class, 'create']);

Route::middleware(['web', 'auth'])->group(function() {
    Route::get('todos', [\App\Http\Controllers\TodoController::class, 'getTodosDT']);
});
