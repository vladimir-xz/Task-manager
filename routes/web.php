<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::resource('profile', ProfileController::class);

Route::resource('tasks', TaskController::class);
Route::resource('task_statuses', TaskStatusController::class);
Route::resource('labels', LabelController::class);

require __DIR__ . '/auth.php';
