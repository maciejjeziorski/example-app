<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/projects', ProjectController::class)
    ->except(['create']);

Route::resource('/projects/{project}/tasks', TaskController::class);

Route::patch('/projects/{project}/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.update_status');
