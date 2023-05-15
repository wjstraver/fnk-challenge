<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfficeIndexResource;
use App\Http\Resources\OfficeResource;
use App\Http\Resources\OrderResource;
use App\Models\Office;
use Inertia\Response;

class OfficeController extends Controller
{
    public function index(): Response
    {
        return inertia('Items/Index', [
            'items' => fn() => OfficeIndexResource::collection(
                Office::query()
                    ->withCount('orders')
                    ->get()
            ),
            'title' => fn() => __('Offices'),
            'page' => fn () => 'offices'
        ]);
    }

    public function show(Office $office): Response
    {
        return inertia('Items/Show', [
            'item' => fn() => OfficeResource::make($office),
            'orders' => fn() => OrderResource::collection(
                $office->orders()->with('customer', 'employee')->get()
            ),
            'title' => fn() => __('Office: ') . $office->name,
            'page' => fn () => 'offices'
        ]);
    }
}
