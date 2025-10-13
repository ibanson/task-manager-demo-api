<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use App\Repositories\BoardRepository;
use Illuminate\Http\JsonResponse;

class BoardController extends Controller
{
    public function __construct(
        protected BoardRepository $boardRepository
    ) {}

    /** Board with linked task(s) */
    public function show(Board $board): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new BoardResource($board->load('tasks')),
        ]);
    }

    /** All Boards with linked task(s) */
    public function index(): JsonResponse
    {
        $data = $this->boardRepository->fetchBoards();

        return response()->json([
            'success' => true,
            'data' => BoardResource::collection($data),
        ]);
    }

        /** Update board */
    public function update(Board $board, UpdateBoardRequest $request): JsonResponse
    {
        $data = $this->boardRepository->updateBoard($board, $request->validated());

        return response()->json([
            'success' => true,
            'data' => new BoardResource($data),
        ]);
    }

    /** Create new board */
    public function store(StoreBoardRequest $request): JsonResponse
    {
        $data = $this->boardRepository->createBoard($request->validated());

        return response()->json([
            'success' => true,
            'data' => new BoardResource($data),
        ]);
    }

    /** Delete board with linked task(s) */
    public function destroy(Board $board)
    {
        $deleted = $this->boardRepository->deleteBoard($board);

        return response()->json([
            'success' => $deleted,
        ]);

    }
}
