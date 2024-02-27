<?php

namespace Database\Seeders\Development;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use App\Models\User;
use App\Models\User\UserRoleClassifier;
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
        $this->createUserSuperAdminRole();

        $member_roles = UserRoleClassifier::getRolesBelongModel(Member::class);

        User::factory(30)->create()->each(function ($user) use ($member_roles) {
            if( $user->profile_type == Contractor::class ) {
                $user->assignRole('contractor');
            }

            if( $user->profile_type == Agency::class ) {
                $user->assignRole('agency');
            }

            if( $user->profile_type == Member::class )
            {
                $role = ! $user->profile->isCrewMember() ? $member_roles->except('worker')->random() : 'worker';
                $user->assignRole($role);
            }
        });
    }

    public function createUserSuperAdminRole()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@mail.com',
            'password' => 'password',
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'profile_type' => Member::class,
            'profile_id' => 1,
            'last_session_at' => now(),
        ])->assignRole('SuperAdmin');
    }
}
