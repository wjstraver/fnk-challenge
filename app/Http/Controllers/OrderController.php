<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\OfficeResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Inertia\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        return inertia('Orders/Index', [
            'orders' => fn() => OrderResource::collection(
                Order::query()
                    ->with('employee', 'office', 'customer')
                    ->get()
            )
        ]);
    }

    public function show(Order $order): Response
    {
        return inertia('Orders/Show', [
            'order' => fn() => OrderResource::make($order),
            'customer' => fn() => CustomerResource::make($order->customer),
            'employee' => fn() => EmployeeResource::make($order->employee),
            'office' => fn() => OfficeResource::make($order->office),
        ]);
    }
}
