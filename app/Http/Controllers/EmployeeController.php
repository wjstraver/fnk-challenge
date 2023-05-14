<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Http\Resources\OrderResource;
use App\Models\Employee;
use Inertia\Response;

class EmployeeController extends Controller
{
    public function index(): Response
    {
        return inertia('Employees/Index', [
            'employees' => fn() => EmployeeResource::collection(
                Employee::query()
                    ->withCount('orders')
                    ->get()
            )
        ]);
    }

    public function show(Employee $employee): Response
    {
        return inertia('Employees/Show', [
            'employee' => fn() => EmployeeResource::make($employee),
            'orders' => fn() => OrderResource::collection(
                $employee->orders()->with('customer', 'office')->get()
            )
        ]);
    }
}
