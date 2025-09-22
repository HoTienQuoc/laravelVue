<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

// Note that the index and store methods do not require a model instance.
// In these case, you need to pass a class name instead of model instance.



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Task::class);

        // if ($request->user()->cannot('viewAny', Task::class)) {
        //     abort(403);
        // }  Remember note ▲
        // return TaskResource::collection(Task::all()); //
        return TaskResource::collection(request()->user()->tasks);
        // return TaskResource::collection(request()->user()->tasks()->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Gate::authorize('create', Task::class);

        // if ($request->user()->cannot('create', Task::class)) {
        //     abort(403);
        // }
        $task = $request->user()->tasks()->create($request->validated());
        return $task->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task, Request $request)
    {
        Gate::authorize('view', $task);

        // if ($request->user()->cannot('view', $task)) {
        //     abort(403);
        // }
        // return new TaskResource($task);//
        // return TaskResource::make($task);//
        return $task->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        // if ($request->user()->cannot('update', $task)) {
        //     abort(403);
        // }
        $task->update($request->validated());
        return $task->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, Request $request)
    {
        Gate::authorize('delete', $task);
        // if ($request->user()->cannot('delete', $task)) {
        //     abort(403);
        // }
        $task->delete();
        return response()->noContent();
    }
}
