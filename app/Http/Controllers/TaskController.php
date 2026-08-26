<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display all the tasks.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = Task::all();

        return Response(TaskResource::collection($tasks), 200);
    }

    /**
     * Create a new task.
     *
     * @return Response
     */
    public function create(TaskRequest $request)
    {
        $payload = $request->only('title');
        $newTask = Task::create($payload);
        $newTask->refresh();

        return Response(new TaskResource($newTask), 201);
    }

    /**
     * Reverse the is_completed field of a specific task.
     *
     * @param  Task  $task  The current task
     * @return Response
     */
    public function reverseTaskStatus(Task $task)
    {
        $reversedStatus = ! $task->is_completed;
        $task->is_completed = $reversedStatus;
        $task->save();

        return Response(new TaskResource($task));
    }

    /**
     * Delete a task.
     *
     * @param  Task  $task  The current task
     * @return Response
     */
    public function delete(Task $task)
    {
        $task->delete();

        return Response([
            'message' => 'Task successfully deleted.',
        ]);
    }
}
