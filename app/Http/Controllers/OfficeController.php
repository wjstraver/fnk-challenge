<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfficeResource;
use App\Http\Resources\OrderResource;
use App\Models\Office;
use Inertia\Response;

class OfficeController extends Controller
{
    public function index(): Response
    {
        return inertia('Offices/Index', [
            'offices' => fn() => OfficeResource::collection(
                Office::query()
                    ->withCount('orders')
                    ->get()
            )
        ]);
    }

    public function show(Office $office): Response
    {
        return inertia('Offices/Show', [
            'office' => fn() => OfficeResource::make($office),
            'orders' => fn() => OrderResource::collection(
                $office->orders()->with('customer', 'employee')->get()
            )
        ]);
    }
}
