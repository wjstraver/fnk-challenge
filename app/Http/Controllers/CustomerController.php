<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
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
            'customer' => function() use ($customer) {
                $customer->loadMissing('orders');

                return CustomerResource::make($customer);
            }
        ]);
    }
}
