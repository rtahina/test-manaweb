<?php

namespace App\Http\Controllers;

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
}
