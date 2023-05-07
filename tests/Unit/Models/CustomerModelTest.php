<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Order;
use Tests\TestCase;

class CustomerModelTest extends TestCase
{
    /** @test */
    public function it_can_return_name_attribute(): void
    {
        $client = new Customer();

        $this->assertEmpty($client->name);

        $client->initials = 'A.B.C.D';

        $this->assertEquals($client->initials, $client->name);

        $client->lastname = 'Test';

        $this->assertEquals("{$client->initials} {$client->lastname}", $client->name);

        $client->initials = null;

        $this->assertEquals($client->lastname, $client->name);
    }

    /** @test */
    public function it_can_get_related_orders(): void
    {
        $customer = Customer::factory()->create();

        Order::factory()
            ->count(4)
            ->for($customer)
            ->create();

        $this->assertCount(4, $customer->orders);
        $this->assertContainsOnlyInstancesOf(Order::class, $customer->orders);
    }
}
