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
                $page->component('Items/Index')
                    ->has(
                        'items',
                        2,
                        fn(Assert $order) => $order->has('link')
                            ->has('ID')
                            ->has(__('Product'))
                            ->has(__('Created At'))
                            ->has(__('Customer'))
                            ->has(__('Employee'))
                            ->has(__('Office'))
                    )
                    ->has('title')
                    ->has('page');
            });
    }

    /** @test */
    public function it_returns_200_on_show(): void
    {
        $this->get(
            route('orders.show', ['order' => $this->orders->first()->id])
        )->assertInertia(function (Assert $page) {
            $page->component('Items/Show')
                ->has('item')
                ->has('title')
                ->has('page');
        });
    }
}
