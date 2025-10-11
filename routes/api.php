<?php

use App\Http\Controllers\api\TaskController;
use Illuminate\Support\Facades\Route;

// Shopify Webhooks
Route::prefix('v1')->group(function () {

    /**
     * Available routes for tasks : (php artisan route:list)
     *
     * | Méthode | URI                 | Action   | Contrôleur             |
     * | ------- | ------------------- | -------- | ---------------------- |
     * | GET     | /v1/tasks          | index    | TaskController@index   | // List all tasks
     * | POST    | /v1/tasks          | store    | TaskController@store   | // Create new task
     * | GET     | /v1/tasks/{task}   | show     | TaskController@show    | // Display single task ( Not useful, excluded)
     * | PUT     | /v1/tasks/{task}   | update   | TaskController@update  | // Complete task update
     * | PATCH   | /v1/tasks/{task}   | update   | TaskController@update  | // Partial task update
     * | DELETE  | /v1/tasks/{task}   | destroy  | TaskController@destroy | // Delete task
     */
    Route::apiResource('tasks', TaskController::class)->except(['show', 'update']);
    Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

});
