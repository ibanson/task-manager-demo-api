<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->truncate();

        $demoUserEmail = env('API_USER_EMAIL_SEEDER');
        $demoUserPassword = env('API_USER_PASSWORD_SEEDER');

        if (! User::where('email', $demoUserEmail)->exists()) {
            User::factory()->create([
                'name' => 'API User',
                'email' => $demoUserEmail,
                'password' => Hash::make($demoUserPassword),
            ]);
        }

        // Feed database
        $this->call([
            TaskSeeder::class,
        ]);
    }
}
