<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Task\CreateTask;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class CreateTaskController extends Controller
{
    /**
     * Create a new task.
     */
    public function __invoke(TaskRequest $request, CreateTask $action): JsonResponse
    {
        $task = $action->handle($request->get('title'));

        return (new TaskResource($task))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
