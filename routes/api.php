<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::post('api/task', [TaskController::class, 'store'])->name('task.store');
Route::get('api/task/{id}', [TaskController::class, 'show'])->name('task.show');
Route::post('api/task/delete', [TaskController::class, 'destroy'])->name('task.destroy');
Route::get('api/task', [TaskController::class, 'index'])->name('task.list');
Route::get('api/user', [UserController::class, 'index'])->name('user.list');
Route::get('api/task/mark_as_completed/{id}', [TaskController::class, 'changeStatus'])->name('task.change-status');