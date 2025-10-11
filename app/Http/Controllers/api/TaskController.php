<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        protected TaskRepository $taskRepository
    ) {}

    public function index(): JsonResponse
    {
        try {
            $data = $this->taskRepository->fetchTasks();

            return response()->json([
                'success' => true,
                'data' => TaskResource::collection($data),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        try {
            $data = $this->taskRepository->updateTask($task, $request->validated());

            return response()->json([
                'success' => true,
                'data' => new TaskResource($data),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        try {
            $data = $this->taskRepository->createTask($request->validated());

            return response()->json([
                'success' => true,
                'data' => new TaskResource($data),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    public function destroy(Task $task): JsonResponse
    {
        try {
            $deleted = $this->taskRepository->deleteTask($task);

            return response()->json([
                'success' => $deleted,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'exception' => $exception->getCode(),
            ]);
        }
    }
}
