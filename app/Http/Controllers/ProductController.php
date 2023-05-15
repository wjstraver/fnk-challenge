<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        return inertia('Items/Index', [
            'items' => fn() => ProductResource::collection(
                Order::query()
                    ->selectRaw('product, COUNT(*) as sale_count')
                    ->groupBy('product')
                    ->get()
            ),
            'title' => fn() => __('Products'),
            'page' => fn () => 'products'
        ]);
    }

    public function show(string $product): Response
    {
        return inertia('Items/Show', [
            'item' => fn() => [
                __('Product') => $product
            ],
            'orders' => fn() => OrderResource::collection(
                Order::query()
                    ->where('product', $product)
                    ->with('office', 'employee', 'customer')
                    ->get()
            ),
            'title' => fn() => __('Product: ') . $product,
            'page' => 'products',
        ]);
    }
}
