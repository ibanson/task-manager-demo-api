<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    /**
     * Create new task
     */
    public function createTask(array $payload): Task
    {
        return Task::create([
            'title' => $payload['title'] ?? null,
        ]);
    }

    /**
     * Return all tasks
     */
    public function fetchTasks(): Collection
    {
        return Task::get();
    }

    /**
     * Update a specific task (partial update)
     */
    public function updateTask(Task $task, array $payload): Task
    {
        $task->update($payload);

        return $task;
    }

    /**
     * Delete a specific task
     */
    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }
}
