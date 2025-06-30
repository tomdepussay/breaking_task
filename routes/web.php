<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/projects/list', [ProjectController::class, 'list'])->name('projects.list');
    Route::post('/project/add', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/project/edit', [ProjectController::class, 'update'])->name('project.edit');
    Route::get('/project/delete', [ProjectController::class, 'delete'])->name('project.delete');
    Route::post('/project/delete', [ProjectController::class, 'destroy'])->name('project.delete');
    Route::get('/projet/{id}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
});

require __DIR__.'/auth.php';
