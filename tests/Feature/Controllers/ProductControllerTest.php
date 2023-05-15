<?php

namespace Tests\Feature\Controllers;

use App\Models\Order;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    protected Collection $products;

    public function setUp(): void
    {
        parent::setUp();

        $this->products = Order::factory()
            ->sequence(
                ['product' => 'abc'],
                ['product' => '123']
            )
            ->count(4)
            ->create();
    }

    /** @test */
    public function it_returns_200_on_index(): void
    {
        $this->get(route('products.index'))
            ->assertInertia(function (Assert $page) {
                $page->component('Items/Index')
                    ->has(
                        'items',
                        2,
                        fn(Assert $product) => $product->has('link')
                            ->has('ID')
                            ->has(__('Product'))
                            ->has(__('Times Sold'))
                    );
            });
    }

    /** @test */
    public function it_returns_200_on_show(): void
    {
        $this->get(
            route('products.show', ['product' => $this->products->first()->product])
        )->assertInertia(function (Assert $page) {
            $page->component('Items/Show')
                ->has('item')
                ->has('orders', 2);
        });
    }
}
