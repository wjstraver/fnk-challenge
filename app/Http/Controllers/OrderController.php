<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Inertia\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        return inertia('Items/Index', [
            'items' => fn() => OrderResource::collection(
                Order::query()
                    ->with('employee', 'office', 'customer')
                    ->get()
            ),
            'title' => fn() => __('Orders'),
            'page' => fn () => 'orders'
        ]);
    }

    public function show(Order $order): Response
    {
        return inertia('Items/Show', [
            'item' => fn() => OrderResource::make($order->loadMissing('office', 'employee', 'customer')),
            'title' => fn() => __('Order: ') . $order->name,
            'page' => fn () => 'orders'
        ]);
    }
}
