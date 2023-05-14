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

        $this->assertEquals($this->order->id, $result['id']);
        $this->assertEquals($this->order->product, $result['product']);
        $this->assertInstanceOf(Carbon::class, $result['createdAt']);
        $this->assertEquals((string)$this->order->created_at, (string)$result['createdAt']);
        $this->assertInstanceOf(MissingValue::class, $result['office']);
        $this->assertInstanceOf(MissingValue::class, $result['customer']);
        $this->assertInstanceOf(MissingValue::class, $result['employee']);
    }

    /** @test */
    public function it_can_return_customer_when_relation_loaded(): void
    {
        $this->order->load('customer');

        $result = $this->resource->toArray(request());

        $this->assertInstanceOf(CustomerResource::class, $result['customer']);

        $this->assertEquals($this->order->customer_id, $result['customer']->id);
    }

    /** @test */
    public function it_can_return_office_when_relation_loaded(): void
    {
        $this->order->load('office');

        $result = $this->resource->toArray(request());

        $this->assertInstanceOf(OfficeResource::class, $result['office']);

        $this->assertEquals($this->order->office_id, $result['office']->id);
    }

    /** @test */
    public function it_can_return_employee_when_relation_loaded(): void
    {
        $this->order->load('employee');

        $result = $this->resource->toArray(request());

        $this->assertInstanceOf(EmployeeResource::class, $result['employee']);

        $this->assertEquals($this->order->employee_id, $result['employee']->id);
    }
}
