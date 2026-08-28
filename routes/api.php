<?php

declare(strict_types=1);

use App\Http\Controllers\CreateTaskController;
use App\Http\Controllers\ListTasksController;
use App\Http\Controllers\ToggleTaskStatusController;
use Illuminate\Support\Facades\Route;

Route::get('tasks', ListTasksController::class);
Route::post('tasks', CreateTaskController::class);
Route::patch('tasks/{id}', ToggleTaskStatusController::class);
// Route::delete('tasks/{task}', [TaskController::class, 'delete']);
