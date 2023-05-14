<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\OfficeResource;
use App\Http\Resources\OrderResource;
use App\Models\Office;
use App\Models\Order;
use Illuminate\Http\Resources\MissingValue;
use Tests\TestCase;

class OfficeResourceTest extends TestCase
{
    protected Office $office;
    protected OfficeResource $resource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->office = Office::factory()->create();

        Order::factory()->for($this->office)->count(5)->create();

        $this->resource = new OfficeResource($this->office);
    }

    /** @test */
    public function it_returns_only_office_when_no_relations_are_loaded(): void
    {
        $result = $this->resource->toArray(request());

        $this->assertEquals($this->office->id, $result['id']);
        $this->assertEquals($this->office->name, $result['name']);
        $this->assertInstanceOf(MissingValue::class, $result['orderCount']);
        $this->assertInstanceOf(MissingValue::class, $result['orders']);
    }

    /** @test */
    public function it_can_return_order_count_when_count_loaded(): void
    {
        $this->office->loadCount('orders');

        $result = $this->resource->toArray(request());

        $this->assertEquals(5, $result['orderCount']);
    }

    /** @test */
    public function it_can_return_orders_when_relation_loaded(): void
    {
        $this->office->load('orders');

        $result = $this->resource->toArray(request());

        $this->assertCount(5, $result['orders']);

        $this->assertContainsOnlyInstancesOf(OrderResource::class, $result['orders']);
    }
}
