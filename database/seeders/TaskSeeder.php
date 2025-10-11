<?php

namespace Database\Seeders;

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
        DB::table('tasks')->truncate();

        $tasksData = [
            ['title' => 'Appeler client A'],
            ['title' => 'Coder la nouvelle fonctionnalité'],
            ['title' => 'Tester l\'application'],
        ];

        foreach ($tasksData as $task) {
            Task::create($task);
        }
    }
}
