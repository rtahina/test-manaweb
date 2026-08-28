<?php

declare(strict_types=1);

use App\Http\Controllers\ListTasksController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('tasks', ListTasksController::class);
// Route::post('tasks', [TaskController::class, 'create']);
// Route::patch('tasks/{task}', [TaskController::class, 'reverseTaskStatus']);
// Route::delete('tasks/{task}', [TaskController::class, 'delete']);
