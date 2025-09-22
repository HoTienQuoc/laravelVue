<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\CompleteTaskController;

// routes/api/v1.php
Route::apiResource('/tasks', TaskController::class)->names([
    'index' => 'tasks.v1.index',
    'store' => 'tasks.v1.store',
    'show' => 'tasks.v1.show',
    'update' => 'tasks.v1.update',
    'destroy' => 'tasks.v1.destroy',
]);

Route::patch('/tasks/{task}/complete', CompleteTaskController::class)->name('tasks.v1.complete');

