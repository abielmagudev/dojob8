<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use App\Models\User;
use App\Models\User\UserRole;
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
            'last_session_at' => now(),
        ])->assignRole('SuperAdmin');


        $member_roles = UserRole::getRolesByClassname(Member::class)->reject(fn($value) => $value == 'worker');

        User::factory(30)->create()->each(function ($user) use ($member_roles) {
            if( $user->profile_type == Contractor::class ) {
                $user->assignRole('contractor');
            }

            if( $user->profile_type == Agency::class ) {
                $user->assignRole('agency');
            }

            if( $user->profile_type == Member::class )
            {
                $role = !$user->profile->isCrewMember() ? $member_roles->random() : 'worker';
                $user->assignRole($role);
            }
        });
    }
}
