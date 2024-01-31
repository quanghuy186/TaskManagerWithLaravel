<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/index', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/create', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/{id}/edit', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/{id}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');