<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Task::class);
        return TaskResource::collection(auth()->user()->tasks()->get());
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(StoreTaskRequest $request): TaskResource
    {
        Gate::authorize('create', Task::class);
        $task = $request->user()->tasks()->create($request->validated());
        return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Task $task): void
    {
        Gate::authorize('view', $task);
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        Gate::authorize('update', $task);
        return TaskResource::make($task);

    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Task $task): Response
    {
        Gate::authorize('delete', $task);
        $task->delete();
        return response()->noContent();
    }
}
