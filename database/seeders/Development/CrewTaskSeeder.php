<?php

namespace Database\Seeders\Development;

use App\Models\Crew;
use App\Models\Task;
use Illuminate\Database\Seeder;

class CrewTaskSeeder extends Seeder
{
    public function run()
    {
        $crews = Crew::all();

        $tasks = Task::all();

        $crews->each(function ($crew) use ($tasks) {
            if( mt_rand(0,1) )
            {
                $crew->tasks()->attach(
                    $tasks->random( mt_rand(1, $tasks->count()) )
                );
            }
        });
    }
}
