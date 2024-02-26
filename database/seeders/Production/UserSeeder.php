<?php

namespace Database\Seeders\Production;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = Member::first();

        User::create([
            'name' => 'username',
            'email' => 'user@mail.com',
            'email_verified_at' => now(),
            'password' => 'password',
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'profile_type' => get_class($member),
            'profile_id' => $member->id,
            'last_session_at' => null,
            'last_session_device' => null,
            'last_session_ip' => null,
            'remember_token' => Str::random(10),
            'is_active' => true,
        ])->assignRole('SuperAdmin');
    }
}
