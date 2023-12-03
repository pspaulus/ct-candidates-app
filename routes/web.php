<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\TodoController::class, 'index'])->name('home');
    Route::post('/todos', [\App\Http\Controllers\TodoController::class, 'store'])->name('todos.create');
    Route::put('/todos/update-completed/{id}', [\App\Http\Controllers\TodoController::class, 'updateCompleted']);
    Route::put('/todos/update-order/{id}', [\App\Http\Controllers\TodoController::class, 'updateOrder']);
    Route::delete('/todos/{id}', [\App\Http\Controllers\TodoController::class, 'destroy'])->name('todos.destroy');
});

Auth::routes();
