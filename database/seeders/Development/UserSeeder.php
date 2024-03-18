<?php

namespace Database\Seeders\Development;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use App\Models\User;
use App\Models\User\Services\RoleCatalogManager;
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
        $model_profiles = [
            'agencies' => Agency::all(),
            'contractors' => Contractor::all(),
            'members' => Member::all(),
        ];

        $member_roles = RoleCatalogManager::byProfile( new Member );

        $profileIdLambda = function ($profile_type) use ($model_profiles)
        {
            if( $profile_type == Contractor::class ) {
                return $model_profiles['contractors']->random()->id;
            }

            if( $profile_type == Agency::class ) {
                return $model_profiles['agencies']->random()->id;
            }

            return $model_profiles['members']->random()->id;
        };

        $profileRoleLambda = function ($user) use ($model_profiles, $member_roles)
        {
            if( $user->profile_type == Contractor::class ) {
                return 'contractor';
            }

            if( $user->profile_type == Agency::class ) {
                return 'agency';
            }

            // Cache $model_profiles['members'], avoid instantiating the member object again
            $member = $model_profiles['members']->get( $user->profile_id ); 

            if( $member && $member->isCrewMember() ) {
                 return 'crew-member';
            }

            return $member_roles->except('crew-member')->random();
        };

        $users = User::factory( mt_rand(1,50) )->make();

        $users->each(function ($u) use ($profileIdLambda, $profileRoleLambda)
        {
            $u->profile_id = $profileIdLambda( $u->profile_type );
            
            $u->save();

            $u->assignRole( $profileRoleLambda($u) );
        });
    }
}
