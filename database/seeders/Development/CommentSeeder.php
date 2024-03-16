<?php

namespace Database\Seeders\Development;

use App\Models\Comment;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $work_orders = WorkOrder::all();

        $comments = Comment::factory( mt_rand(1,1000) )->make();

        $comments->each(function ($c) use ($users, $work_orders) {
            $c->user_id = $users->random()->id;
            $c->work_order_id = $work_orders->random()->id;
            $c->save();
        });
    }
}
