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
                $page->component('Products/Index')
                    ->has(
                        'products',
                        2,
                        fn(Assert $product) => $product->has('product')
                            ->has('saleCount')
                    );
            });
    }

    /** @test */
    public function it_returns_200_on_show(): void
    {
        $this->get(
            route('products.show', ['product' => $this->products->first()->product])
        )->assertInertia(function (Assert $page) {
            $page->component('Products/Show')
                ->has('product')
                ->has('orders', 2);
        });
    }
}
