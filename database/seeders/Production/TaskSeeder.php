<?php

namespace Database\Seeders\Production;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            'assessments',
            'inspections',
            'work orders',
        ];

        foreach($tasks as $name)
        {
            Task::create([
                'name' => $name,
            ]);
        }
    }
}
