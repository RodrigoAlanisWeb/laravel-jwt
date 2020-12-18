<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        for ($i=1; $i <= 10; $i++) { 
            Task::create([
                'title' => 'Task #' . $i,
                'description' => 'descripcion de el Task #' . $i,
                'user_id' => $i,
            ]);
        };
    }
}
