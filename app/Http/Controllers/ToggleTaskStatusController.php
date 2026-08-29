<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Task\ToggleTaskStatus;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class ToggleTaskStatusController extends Controller
{
    /**
     * Toggle task status (is_completed).
     */
    public function __invoke(int $id, ToggleTaskStatus $action): JsonResponse
    {
        $task = $action->handle($id);

        return (new TaskResource($task))->response()->setStatusCode(Response::HTTP_OK);
    }
}
