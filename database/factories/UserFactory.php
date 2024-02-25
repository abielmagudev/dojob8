<?php

namespace Database\Factories;

use App\Models\Contractor;
use App\Models\Member;
use App\Models\User\UserProfiler;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $classname_random = $this->faker->randomElement( UserProfiler::classnames() );

        if( $classname_random == Member::class )
        {
            $max_profile_id = 35;
        } 
        elseif( $classname_random == Contractor::class )
        {
            $max_profile_id = 10;
        }
        else
        {
            $max_profile_id = 3;
        }

        return [
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password', // Mutator
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'profile_type' => $classname_random,
            'profile_id' => $this->faker->numberBetween(1, $max_profile_id),
            'last_session_at' => $this->faker->dateTime(),
            'last_session_device' => $this->faker->optional()->randomElement(['desktop','mobile','tablet']),
            'last_session_ip' => $this->faker->optional()->ipv4(),
            'remember_token' => Str::random(10),
            'is_active' => (int) $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
