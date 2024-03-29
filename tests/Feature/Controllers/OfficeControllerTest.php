<?php

namespace Tests\Feature\Controllers;

use App\Models\Office;
use App\Models\Order;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class OfficeControllerTest extends TestCase
{
    protected Collection $offices;

    public function setUp(): void
    {
        parent::setUp();

        $this->offices = Office::factory()->count(2)->create();

        Order::factory()
            ->times(4)
            ->sequence(
                ['office_id' => $this->offices->first()->id],
                ['office_id' => $this->offices->last()->id],
            )
            ->create();
    }

    /** @test */
    public function it_returns_200_on_index(): void
    {
        $this->get(route('offices.index'))
            ->assertInertia(function (Assert $page) {
                $page->component('Items/Index')
                    ->has(
                        'items',
                        2,
                        fn(Assert $office) => $office->has('link')
                            ->has('ID')
                            ->has(__('Name'))
                            ->has(__('Sold Orders'))
                    )
                    ->has('title')
                    ->has('page');
            });
    }

    /** @test */
    public function it_returns_200_on_show(): void
    {
        $this->get(
            route('offices.show', ['office' => $this->offices->first()->id])
        )->assertInertia(function (Assert $page) {
            $page->component('Items/Show')
                ->has('item')
                ->has('orders', 2)
                ->has('title')
                ->has('page');
        });
    }
}
