<?php

use App\Http\Controllers\api\BoardController;
use App\Http\Controllers\api\TaskController;
use Illuminate\Support\Facades\Route;

// Shopify Webhooks
Route::prefix('v1')->group(function () {

    /**
     * Available routes for tasks : (php artisan route:list)
     * GET v1/boards List boards with tasks
     *
     * POST v1/boards Add new board
     * PUT/PATCH /v1/boards/{board} Update existing board
     * DELETE /v1/boards/{board} Delete existing board (with associated tasks)
     *
     * POST v1/boards/{board}/tasks Add new task to a board
     * DELETE v1/boards/{board}/tasks/{task} Delete task from a board
     * PATCH v1/boards/{board}/tasks/{task} Update board task
     */
    Route::apiResource('boards', BoardController::class);
    Route::apiResource('boards.tasks', TaskController::class)->except(['update', 'show', 'index']);
    Route::patch('boards/{board}/tasks/{task}', [TaskController::class, 'update']);

});
