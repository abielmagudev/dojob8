<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@mail.com',
            'password' => 'password',
            'profile_type' => Member::class,
            'profile_id' => 1,
        ]);

        User::factory(10)->create();
    }
}
