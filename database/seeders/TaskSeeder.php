<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boards')->truncate();
        DB::table('tasks')->truncate();

        $boardsData = [
            [
            'title' => 'Board Projets',
            'tasks' => [
                ['title' => 'Appeler client A'],
                ['title' => 'Coder la nouvelle fonctionnalité'],
            ],
        ],
        [
            'title' => 'Board Perso',
            'tasks' => [
                ['title' => 'Aller chez Costco =)'],
                ['title' => 'Rappeler le vétérinaire'],
            ],
        ],
        ];



        foreach ($boardsData as $board) {

            // Isolate tasks
            $tasks = $board['tasks'] ?? [];
            unset($board['tasks']);

            $boardEntity = Board::create($board);
            $boardEntity->tasks()->createMany($tasks);
        }
    }
}
