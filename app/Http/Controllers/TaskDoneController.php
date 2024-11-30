<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskDoneController extends Controller
{
    public function __invoke(Request $request, Task $task): TaskResource
    {
        $task->is_completed = $request->is_completed;
        $task->save();
        return TaskResource::make($task);
    }
}
