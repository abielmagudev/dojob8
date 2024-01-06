<?php

namespace Database\Factories;

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
        return [
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'profile_type' => $this->faker->randomElement( UserProfiler::getProfiles() ),
            'profile_id' => $this->faker->numberBetween(1, 10),
            'is_active' => (int) $this->faker->boolean(),
            'last_session_ip' => $this->faker->optional()->ipv4(),
            'last_session_device' => $this->faker->optional()->randomElement(['desktop','mobile','tablet']),
            'last_session_at' => $this->faker->optional()->dateTime(),
            'remember_token' => Str::random(10),
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
