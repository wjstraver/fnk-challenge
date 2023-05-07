<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\Order;
use Tests\TestCase;

class EmployeeModelTest extends TestCase
{
    /** @test */
    public function it_can_get_related_orders(): void
    {
        $employee = Employee::factory()->create();

        Order::factory()
            ->count(4)
            ->for($employee)
            ->create();

        $this->assertCount(4, $employee->orders);
        $this->assertContainsOnlyInstancesOf(Order::class, $employee->orders);
    }
}
