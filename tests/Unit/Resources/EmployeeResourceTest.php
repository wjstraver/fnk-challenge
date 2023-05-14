<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\EmployeeResource;
use App\Http\Resources\OrderResource;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Http\Resources\MissingValue;
use Tests\TestCase;

class EmployeeResourceTest extends TestCase
{
    protected Employee $employee;
    protected EmployeeResource $resource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->employee = Employee::factory()->create();

        Order::factory()->for($this->employee)->count(5)->create();

        $this->resource = new EmployeeResource($this->employee);
    }

    /** @test */
    public function it_returns_only_employee_when_no_relations_are_loaded(): void
    {
        $result = $this->resource->toArray(request());

        $this->assertEquals($this->employee->id, $result['id']);
        $this->assertEquals($this->employee->name, $result['name']);
        $this->assertInstanceOf(MissingValue::class, $result['orderCount']);
        $this->assertInstanceOf(MissingValue::class, $result['orders']);
    }

    /** @test */
    public function it_can_return_order_count_when_count_loaded(): void
    {
        $this->employee->loadCount('orders');

        $result = $this->resource->toArray(request());

        $this->assertEquals(5, $result['orderCount']);
    }

    /** @test */
    public function it_can_return_orders_when_relation_loaded(): void
    {
        $this->employee->load('orders');

        $result = $this->resource->toArray(request());

        $this->assertCount(5, $result['orders']);

        $this->assertContainsOnlyInstancesOf(OrderResource::class, $result['orders']);
    }
}
