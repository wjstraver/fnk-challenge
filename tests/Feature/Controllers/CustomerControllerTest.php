<?php

namespace Tests\Feature\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    protected Collection $customers;

    public function setUp(): void
    {
        parent::setUp();

        $this->customers = Customer::factory()->count(2)->create();

        Order::factory()
            ->times(4)
            ->sequence(
                ['customer_id' => $this->customers->first()->id],
                ['customer_id' => $this->customers->last()->id],
            )
            ->create();
    }

    /** @test */
    public function it_returns_200_on_index(): void
    {
        $this->get(route('customers.index'))
            ->assertInertia(function (Assert $page) {
                $page->component('Customers/Index')
                    ->has(
                        'customers',
                        2,
                        fn(Assert $customer) => $customer->has('orderCount')
                            ->has('name')
                            ->has('initials')
                            ->has('id')
                            ->has('lastname')
                    );
            });
    }

    /** @test */
    public function it_returns_200_on_show(): void
    {
        $this->get(
            route('customers.show', ['customer' => $this->customers->first()->id])
        )->assertInertia(function( Assert $page) {
            $page->component('Customers/Show')
                ->has('customer')
                ->has('customer.orders', 2);
        });
    }
}
