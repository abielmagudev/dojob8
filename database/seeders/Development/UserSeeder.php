<?php

namespace Database\Seeders\Development;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use App\Models\User;
use App\Models\User\UserRoleClassifier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member_roles = UserRoleClassifier::getRolesBelongModel(Member::class);

        User::factory(30)->create()->forget(1)->each(function ($user) use ($member_roles) {

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
}
