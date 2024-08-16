<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::singleton('profile', ProfileController::class)->destroyable();
    Route::resource('tasks', TaskController::class)->except([
        'index', 'show'
    ]);
    Route::resource('task_statuses', TaskStatusController::class)
        ->except(['index', 'show']);
    Route::resource('labels', LabelController::class)
        ->except(['index', 'show']);
});


Route::resource('tasks', TaskController::class)->only([
    'index', 'show'
]);
Route::resource('task_statuses', TaskStatusController::class)->only([
    'index'
]);
Route::resource('labels', LabelController::class)->only([
    'index'
]);

require __DIR__ . '/auth.php';
