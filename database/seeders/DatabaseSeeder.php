<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
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
        Project::factory()
            ->has(
                Task::factory()
                    ->withOptionalFields()
                    ->count(20)
            )
            ->count(50)
            ->create();
    }
}
