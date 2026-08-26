<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('tasks', [TaskController::class, 'index']);
Route::post('tasks', [TaskController::class, 'create']);
Route::patch('tasks/{task}', [TaskController::class, 'reverseTaskStatus']);
Route::delete('tasks/{task}', [TaskController::class, 'delete']);
