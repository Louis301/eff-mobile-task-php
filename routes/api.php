<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Все маршруты будут иметь префикс /api
Route::apiResource('tasks', TaskController::class);