<?php

namespace App\Repositories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Collection;

class BoardRepository
{
    /**
     * Create new board
     */
    public function createBoard(array $payload): Board
    {
        return Board::create([
            'title' => $payload['title'] ?? null,
        ]);
    }

    /**
     * Return board with tasks
     */
    public function fetchBoard(Board $board): Board
    {
        return $board->load('tasks');
    }

    /**
     * Return all tasks
     */
    public function fetchBoards(): Collection
    {
        return Board::with('tasks')->get();
    }

    /**
     * Delete a specific board
     */
    public function deleteBoard(Board $board): bool
    {
        return $board->delete();
    }

}
