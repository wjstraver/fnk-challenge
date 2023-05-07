<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product' => fake()->word(),
            'customer_id' => Customer::factory(),
            'office_id' => Office::factory(),
            'employee_id' => Employee::factory()
        ];
    }
}
