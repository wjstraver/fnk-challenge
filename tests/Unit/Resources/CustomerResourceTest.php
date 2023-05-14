<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Resources\MissingValue;
use Tests\TestCase;

class CustomerResourceTest extends TestCase
{
    protected Customer $customer;
    protected CustomerResource $resource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = Customer::factory()->create();

        Order::factory()->for($this->customer)->count(5)->create();

        $this->resource = new CustomerResource($this->customer);
    }

    /** @test */
    public function it_returns_only_customer_when_no_relations_are_loaded(): void
    {
        $result = $this->resource->toArray(request());

        $this->assertEquals($this->customer->id, $result['id']);
        $this->assertEquals($this->customer->name, $result['name']);
        $this->assertEquals($this->customer->initials, $result['initials']);
        $this->assertEquals($this->customer->lastname, $result['lastname']);
        $this->assertInstanceOf(MissingValue::class, $result['orderCount']);
        $this->assertInstanceOf(MissingValue::class, $result['orders']);
    }

    /** @test */
    public function it_can_return_order_count_when_count_loaded(): void
    {
        $this->customer->loadCount('orders');

        $result = $this->resource->toArray(request());

        $this->assertEquals(5, $result['orderCount']);
    }

    /** @test */
    public function it_can_return_orders_when_relation_loaded(): void
    {
        $this->customer->load('orders');

        $result = $this->resource->toArray(request());

        $this->assertCount(5, $result['orders']);

        $this->assertContainsOnlyInstancesOf(OrderResource::class, $result['orders']);
    }
}
