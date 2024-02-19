<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTaskController;
use App\Http\Controllers\ApiUsersController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->get('/tasks', [ApiTaskController::class, 'index']);
Route::middleware('auth:sanctum')->post('/tasks', [ApiTaskController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/tasks/{id}', [ApiTaskController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/tasks/{task}', [ApiTaskController::class, 'update']);
// Route::resource('tasks', ApiTaskController::class )->names('api.tasks');
Route::resource('users', ApiUsersController::class )->names('api.users');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
