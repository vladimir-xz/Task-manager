<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::singleton('profile', ProfileController::class)->destroyable();

Route::resources([
    'tasks' => TaskController::class,
    'task_statuses' => TaskStatusController::class,
    'labels' => LabelController::class
]);

require __DIR__ . '/auth.php';
