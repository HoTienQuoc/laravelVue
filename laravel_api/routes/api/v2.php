<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\TaskController;
use App\Http\Controllers\Api\V2\CompleteTaskController;

// routes/api/v2.php
Route::apiResource('/tasks', TaskController::class)->names([
    'index' => 'tasks.v2.index',
    'store' => 'tasks.v2.store',
    'show' => 'tasks.v2.show',
    'update' => 'tasks.v2.update',
    'destroy' => 'tasks.v2.destroy',
]);

Route::patch('/tasks/{task}/complete', CompleteTaskController::class)->name('tasks.v2.complete');

