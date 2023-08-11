<?php

use App\Http\Controllers\TodolistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('todo-list', TodolistController::class);

//Route::get('todo-list', [TodolistController::class, 'index'])->name('todo-list.index');
//Route::get('todo-list/{list}', [TodolistController::class, 'show'])->name('todo-list.show');
//Route::post('todo-list', [TodolistController::class, 'store'])->name('todo-list.store');
//Route::patch('todo-list/{list}', [TodolistController::class, 'update'])->name('todo-list.update');
//Route::delete('todo-list/{list}', [TodolistController::class, 'destroy'])->name('todo-list.destroy');
