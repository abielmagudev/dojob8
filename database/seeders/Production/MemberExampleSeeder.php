<?php

namespace Database\Seeders\Production;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'name' => 'Name',
            'last_name' => 'Lastname',
            'full_name' => 'Full name',
            'birthdate' => null,
            'mobile_number' => null,
            'phone_number' => null,
            'email' => 'user@mail.com',
            'position' => null,
            'is_crew_member' => false,
            'notes' => null,
            'is_available' => true,
        ]);
    }
}