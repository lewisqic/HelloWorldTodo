<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendIndexController;

// Frontend routes
Route::controller(FrontendIndexController::class)->group(function () {
    Route::get('todo', 'todoApp');
    Route::get('todo/tasks', 'getTasks');
    Route::post('todo/tasks', 'createTask');
    Route::put('todo/tasks/{id}', 'updateTask');
    Route::delete('todo/tasks/{id}', 'deleteTask');
});
