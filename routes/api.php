<?php

use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route :: get ('/tasks', [TasksController::class, 'index']);
Route :: post ('/tasks', [TasksController::class, 'create']);
Route :: put ('/tasks/{id}',[TasksController::class, 'update']);
Route :: delete ('/tasks/{id}', [TasksController::class, 'delete']);
Route :: get ('/users', [UsersController::class, 'users']);
Route :: post ('/login', [UsersController::class, 'login']);
Route :: post ('/register', [UsersController::class, 'register']);
