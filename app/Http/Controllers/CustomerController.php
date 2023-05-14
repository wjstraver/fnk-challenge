<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use Inertia\Response;

class CustomerController extends Controller
{
    public function index(): Response
    {
        return inertia('Customers/Index', [
            'customers' => fn() => CustomerResource::collection(
                Customer::query()
                    ->withCount('orders')
                    ->get()
            )
        ]);
    }

    public function show(Customer $customer): Response
    {
        return inertia('Customers/Show', [
            'customer' => fn() => CustomerResource::make($customer),
            'orders' => fn() => OrderResource::collection(
                $customer->orders()->with('office', 'employee')->get()
            )
        ]);
    }
}
