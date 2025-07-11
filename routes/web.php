<?php

use App\Http\Controllers\ColumnController;
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
    Route::prefix('project')->name('project.')->group(function () {
        Route::get('/index', [ProjectController::class, 'index'])->name('index');
        Route::post('/store', [ProjectController::class, 'store'])->name('store');
        Route::get('/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/update', [ProjectController::class, 'update'])->name('update');
        Route::get('/delete', [ProjectController::class, 'delete'])->name('delete');
        Route::post('/destroy', [ProjectController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{id}/calendar/month', [ProjectController::class, 'calendarMonthPartial'])->name('calendar.month.partial');
    });

    Route::prefix('task')->name('task.')->group(function () {
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/store', [TaskController::class, 'store'])->name('store');
    });

    Route::prefix('column')->name('column.')->group(function () {
        Route::get('/show', [ColumnController::class, 'show'])->name('show');
    });
});

require __DIR__.'/auth.php';
