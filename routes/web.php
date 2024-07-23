<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
})->name('main');

Route::resource('task_statuses', TaskStatusController::class)->only([
    'index'
]);

Route::resource('tasks', TaskController::class)->only([
    'index', 'show'
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class)->only([
        'show'
    ]);
    Route::resource('task_statuses', TaskStatusController::class)->except([
        'index', 'show'
    ])->missing(function (Request $request) {
        return redirect()->route('task_statuses.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
