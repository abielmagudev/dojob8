<?php

namespace Database\Seeders\Production;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExampleMemberSuperAdminSeeder extends Seeder
{
    public function run()
    {
        $member = Member::create([
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
        ]);

        $member->users()->create([
            'name' => 'username',
            'email' => 'user@mail.com',
            'password' => 'password',
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'last_session_at' => null,
            'last_session_device' => null,
            'last_session_ip' => null,
            'remember_token' => Str::random(10),
        ]);

        $member->users()->first()->assignRole('SuperAdmin');
    }
}
