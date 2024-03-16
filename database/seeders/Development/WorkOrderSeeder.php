<?php

namespace Database\Seeders\Development;

use App\Models\Assessment;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\Member;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $work_orders = WorkOrder::factory( mt_rand(1, 2000) )->make();

        $work_orders = $this->setRelationships($work_orders);

        $work_orders = $this->setUsers($work_orders);

        $this->save($work_orders);
    }

    protected function setRelationships(Collection $work_orders)
    {
        $relationships = (object) [
            'clients' => Client::all(),
            'jobs' => Job::all(),
            'crews' => Crew::where('purposes_stringify', 'like', 'work orders')->get(),
            'contractors' => Contractor::all(),
            'assessments' => Assessment::all(),
        ];


        $work_orders->each(function ($wo) use ($relationships)
        {
            $wo->client_id = $relationships->clients->random()->id;
            $wo->job_id = $relationships->jobs->random()->id;
            $wo->crew_id = mt_rand(0,1) ? $relationships->crews->random()->id : null;
            $wo->contractor_id = mt_rand(0,1) ? $relationships->contractors->random()->id : null;
            $wo->assessment_id = mt_rand(0,1) && $wo->type == 'standard' ? $relationships->assessments->random()->id : null;
        });
        
        return $work_orders;
    }

    protected function setUsers(Collection $work_orders)
    {
        $member_users = User::with('roles')->where('profile_type', Member::class)->get();

        $users = (object) [
            'management' => $member_users->filter(fn($u) => ! $u->hasAnyRole(['crew-member', 'payments']) ),
            'process' => $member_users->filter(fn($u) => ! $u->hasRole('payments')),
        ];

        $work_orders->each(function ($wo) use ($users)
        {
            $wo->created_id = $users->management->random()->id;
            $wo->updated_id = $users->management->random()->id;
            $wo->working_id = $wo->hasWorkingAt() ? $users->process->random()->id : null;
            $wo->done_id = $wo->hasDoneAt() ? $users->process->random()->id : null;
            $wo->completed_id = $wo->hasCompletedAt() ? $users->management->random()->id : null;
        });

        return $work_orders;
    }

    protected function save(Collection $work_orders)
    {
        // Create all work orders with their data
        $work_orders->each(function($wo)
        {
            // Save work order to generate id
            $wo->save();
            
            // Reload model after saved
            $wo->refresh();
        });


        // Set rectification_id when the work orders are type: rework, warranty

        $work_orders_standard = $work_orders->filter(fn($wo) => $wo->type == 'standard');

        $work_orders->each(function ($wo) use ($work_orders_standard)
        {
            if( $wo->type <> 'standard' ) {
                $wo->rectification_id = $work_orders_standard->random()->id;
                $wo->save();
            }
        });

        // Loads crew members for each work order
        $work_orders->load('crew.members');
        
        // Attach crew members for each work order if has crew
        $work_orders->each(function ($wo) 
        {
            if( $wo->hasCrew() ) {
                $wo->members()->attach( $wo->crew->members );
            }
        });
    }
}
