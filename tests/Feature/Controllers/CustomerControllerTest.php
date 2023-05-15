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
                $page->component('Items/Index')
                    ->has(
                        'items',
                        2,
                        fn(Assert $customer) => $customer->has('link')
                            ->has('ID')
                            ->has(__('Initials'))
                            ->has(__("Lastname"))
                            ->has(__("Orders"))
                    )
                    ->has('title')
                    ->has('page');
            });
    }

    /** @test */
    public function it_returns_200_on_show(): void
    {
        $this->get(
            route('customers.show', ['customer' => $this->customers->first()->id])
        )->assertInertia(function (Assert $page) {
            $page->component('Items/Show')
                ->has('item')
                ->has('orders', 2)
                ->has('title')
                ->has('page');
        });
    }
}
