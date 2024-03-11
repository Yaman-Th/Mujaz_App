<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TaylorNetwork\UsernameGenerator\Generator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class adminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $generator = new Generator();
        $random = str_shuffle('12345678abcdefghijklmnopqrstuvwxyz');
        $name = substr($random, 0, 3);
        $password = substr($random, 0, 8);
        //$username = substr($random, 0, 5);

        $username = "AD " . $generator->generate('Admin');

        return [
            'name' => "admin_" . $name,
            'username' => $username,
            'password' => $password,
            'role' => 'admin',
            'remember_token' => Str::random(10)
        ];
    }
}
