<?php

namespace Tests\Feature\Controllers;

use App\Models\Employee;
use App\Models\Order;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    protected Collection $employees;

    public function setUp(): void
    {
        parent::setUp();

        $this->employees = Employee::factory()->count(2)->create();

        Order::factory()
            ->times(4)
            ->sequence(
                ['employee_id' => $this->employees->first()->id],
                ['employee_id' => $this->employees->last()->id],
            )
            ->create();
    }

    /** @test */
    public function it_returns_200_on_index(): void
    {
        $this->get(route('employees.index'))
            ->assertInertia(function (Assert $page) {
                $page->component('Items/Index')
                    ->has(
                        'items',
                        2,
                        fn(Assert $employee) => $employee->has('link')
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
            route('employees.show', ['employee' => $this->employees->first()->id])
        )->assertInertia(function (Assert $page) {
            $page->component('Items/Show')
                ->has('item')
                ->has('orders', 2)
                ->has('title')
                ->has('page');
        });
    }
}
