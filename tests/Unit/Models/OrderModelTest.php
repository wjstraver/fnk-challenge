<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Order;
use Tests\TestCase;

class OrderModelTest extends TestCase
{
    /** @test */
    public function it_can_get_related_customer(): void
    {
        $customer = Customer::factory()->create();
        $order = new Order(
            [
                'customer_id' => $customer->id
            ]
        );

        $this->assertInstanceOf(Customer::class, $order->customer);
        $this->assertEquals($customer->id, $order->customer->id);
    }

    /** @test */
    public function it_can_get_related_office(): void
    {
        $office = Office::factory()->create();
        $order = new Order(
            [
                'office_id' => $office->id
            ]
        );

        $this->assertInstanceOf(Office::class, $order->office);
        $this->assertEquals($office->id, $order->office->id);
    }

    /** @test */
    public function it_can_get_related_employee(): void
    {
        $employee = Employee::factory()->create();
        $order = new Order(
            [
                'employee_id' => $employee->id
            ]
        );

        $this->assertInstanceOf(Employee::class, $order->employee);
        $this->assertEquals($employee->id, $order->employee->id);
    }
}
