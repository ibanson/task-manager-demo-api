<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoardTaskRequest;
use App\Http\Requests\UpdateBoardTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Board;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskController extends Controller
{
    public function __construct(
        protected TaskRepository $taskRepository
    ) {}

    /** Create new task */
    public function store(StoreBoardTaskRequest $request, Board $board): JsonResponse
    {
        $data = $this->taskRepository->createTask($board, $request->validated());

        return response()->json([
            'success' => true,
            'data' => new TaskResource($data),
        ]);
    }

    public function update(Board $board, Task $task, UpdateBoardTaskRequest $request): JsonResponse
    {
        if ($task->board->id !== $board->id) {
            throw new NotFoundHttpException('Task not found on this board');
        }

        $data = $this->taskRepository->updateTask($board, $task, $request->validated());

        return response()->json([
            'success' => true,
            'data' => new TaskResource($data),
        ]);
    }

    public function destroy(Task $task): JsonResponse
    {
        $deleted = $this->taskRepository->deleteTask($task);

        return response()->json([
            'success' => $deleted,
        ]);
    }
}
