<?php

namespace App\Repositories;

use App\Models\Board;
use App\Models\Task;

class TaskRepository
{
    /**
     * Create new task
     */
    public function createTask(Board $board, array $payload): Task
    {
        return $board->tasks()->create([
            'title' => $payload['title'] ?? null,
        ]);
    }

    /**
     * Update task
     */
    public function updateTask(Board $board, Task $task, array $payload): Task
    {
        $task->update($payload);

        return $task;
    }

    /**
     * Delete task
     */
    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }
}
