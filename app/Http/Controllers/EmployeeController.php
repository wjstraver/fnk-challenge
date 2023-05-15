<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeIndexResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\OrderResource;
use App\Models\Employee;
use Inertia\Response;

class EmployeeController extends Controller
{
    public function index(): Response
    {
        return inertia('Items/Index', [
            'items' => fn() => EmployeeIndexResource::collection(
                Employee::query()
                    ->withCount('orders')
                    ->get()
            ),
            'title' => fn() => __('Employees'),
            'page' => fn () => 'employees'
        ]);
    }

    public function show(Employee $employee): Response
    {
        return inertia('Items/Show', [
            'item' => fn() => EmployeeResource::make($employee),
            'orders' => fn() => OrderResource::collection(
                $employee->orders()->with('customer', 'office')->get()
            ),
            'title' => fn() => __('Employee: ') . $employee->name,
            'page' => fn () => 'employees'
        ]);
    }
}
