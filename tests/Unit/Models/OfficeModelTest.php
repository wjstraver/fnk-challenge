<?php

namespace Tests\Unit\Models;

use App\Models\Office;
use App\Models\Order;
use Tests\TestCase;

class OfficeModelTest extends TestCase
{
    /** @test */
    public function it_can_get_related_orders(): void
    {
        $office = Office::factory()->create();

        Order::factory()
            ->count(4)
            ->for($office)
            ->create();

        $this->assertCount(4, $office->orders);
        $this->assertContainsOnlyInstancesOf(Order::class, $office->orders);
    }
}
