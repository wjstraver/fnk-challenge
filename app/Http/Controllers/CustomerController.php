<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerIndexResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use Inertia\Response;

class CustomerController extends Controller
{
    public function index(): Response
    {
        return inertia('Items/Index', [
            'items' => fn() => CustomerIndexResource::collection(
                Customer::query()
                    ->withCount('orders')
                    ->get()
            ),
            'title' => fn() => __('Customers'),
            'page' => fn () => 'customers'
        ]);
    }

    public function show(Customer $customer): Response
    {
        return inertia('Items/Show', [
            'item' => fn() => CustomerResource::make($customer),
            'orders' => fn() => OrderResource::collection(
                $customer->orders()->with('office', 'employee')->get()
            ),
            'title' => fn() => __('Customer: ') . $customer->name,
            'page' => fn () => 'customers'
        ]);
    }
}
