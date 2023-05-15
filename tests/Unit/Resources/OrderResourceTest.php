<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\OfficeResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Resources\MissingValue;
use Tests\TestCase;

class OrderResourceTest extends TestCase
{
    protected Order $order;
    protected OrderResource $resource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->order = Order::factory()->create();

        $this->resource = new OrderResource($this->order);
    }

    /** @test */
    public function it_returns_only_order_when_no_relations_are_loaded(): void
    {
        $result = $this->resource->toArray(request());

        $this->assertEquals($this->order->id, $result['ID']);
        $this->assertEquals(route('orders.show', ['order' => $this->order->id]), $result['link']);
        $this->assertArrayHasKey(__('Product'), $result);
        $this->assertArrayHasKey(__('Created At'), $result);
        $this->assertInstanceOf(MissingValue::class, $result[__('Customer')]);
        $this->assertInstanceOf(MissingValue::class, $result[__('Employee')]);
        $this->assertInstanceOf(MissingValue::class, $result[__('Office')]);
    }

    /** @test */
    public function it_can_return_customer_when_relation_loaded(): void
    {
        $this->order->load('customer');

        $result = $this->resource->toArray(request());

        $this->assertEquals($this->order->customer->name, $result[__("Customer")]);
    }

    /** @test */
    public function it_can_return_office_when_relation_loaded(): void
    {
        $this->order->load('office');

        $result = $this->resource->toArray(request());

        $this->assertEquals($this->order->office->name, $result[__('Office')]);
    }

    /** @test */
    public function it_can_return_employee_when_relation_loaded(): void
    {
        $this->order->load('employee');

        $result = $this->resource->toArray(request());

        $this->assertEquals($this->order->employee->name, $result[__('Employee')]);
    }
}
