<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodolistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('todo-list', TodolistController::class);
Route::apiResource('todo-list.task', TaskController::class)
    ->except('show')
    ->shallow();

Route::post('registration', RegisterController::class)->name('register');
Route::post('login', LoginController::class)->name('login');

