<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use TaylorNetwork\UsernameGenerator\Generator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$generator = new Generator();
        $random = str_shuffle('12345678abcdefghijklmnopqrstuvwxyz');
        $number = substr(str_shuffle('1234567890'), 0, 3);
        $name = substr($random, 0, 3);
        $password = substr($random, 0, 8);
        //$username = substr($random, 0, 5);

        $username = "AD_" . "Admin" . $number;

        return [
            'name' => "admin_" . $name,
            'username' => $username,
            'password' => Hash::make('adminpassword'),
            'role' => 'admin',
            'remember_token' => Str::random(10)
        ];
        /*
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
        */
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
