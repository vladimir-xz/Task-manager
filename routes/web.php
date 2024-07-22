<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
})->name('main');

Route::resource('task_statuses', TaskStatusController::class)->only([
    'index'
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('task_statuses', TaskStatusController::class)->except([
        'index', 'show'
    ])->missing(function (Request $request) {
        return redirect()->route('task_statuses.index');
    });
});

require __DIR__ . '/auth.php';
