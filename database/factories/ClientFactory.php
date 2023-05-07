<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'initials' => fake()->regexify('([A-Z]\.){1,3}'),
            'lastname' => fake()->lastName()
        ];
    }
}
