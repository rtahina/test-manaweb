<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Task\ListTasks;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

final class ListTasksController extends Controller
{
    /**
     * Display all the tasks.
     */
    public function __invoke(ListTasks $action): JsonResponse
    {
        $tasks = $action->handle();

        return TaskResource::collection($tasks)->response();
    }
}
