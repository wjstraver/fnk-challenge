<?php

namespace Tests\Feature\Controllers;

use App\Models\Order;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    protected Collection $orders;

    public function setUp(): void
    {
        parent::setUp();

        $this->orders = Order::factory()->count(2)->create();
    }

    /** @test */
    public function it_returns_200_on_index(): void
    {
        $this->get(route('orders.index'))
            ->assertInertia(function (Assert $page) {
                $page->component('Orders/Index')
                    ->has(
                        'orders',
                        2,
                        fn(Assert $order) => $order->has('id')
                            ->has('product')
                            ->has('createdAt')
                            ->has('office')
                            ->has('employee')
                            ->has('customer')
                    );
            });
    }

    /** @test */
    public function it_returns_200_on_show(): void
    {
        $this->get(
            route('orders.show', ['order' => $this->orders->first()->id])
        )->assertInertia(function (Assert $page) {
            $page->component('Orders/Show')
                ->has('order')
                ->has('customer')
                ->has('employee')
                ->has('office');
        });
    }
}
