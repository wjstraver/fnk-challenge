<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OrderImport implements WithHeadingRow, ToModel, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected array $customerIdMap = [];
    protected array $officeIdMap = [];
    protected array $employeeIdMap = [];

    public function model(array $row): Order
    {
        [$office, $employee] = explode(' / ', $row['vestiging_verkoper']);

        $order = new Order(
            [
                'product' => $row['product'],
                'customer_id' => $this->getCustomerId($row['koper']),
                'office_id' => $this->getOfficeId($office),
                'employee_id' => $this->getEmployeeId($employee),
            ]
        );
        $order->id = $row['id'] ?? null;
        $order->created_at = Carbon::createFromFormat('d/m/Y H:i', $row['datum_tijd']);

        return $order;
    }

    public function getCustomerId(string $customerName): int
    {
        if (isset($this->customerIdMap[$customerName])) {
            return $this->customerIdMap[$customerName];
        }

        $nameArray = explode(' ', $customerName);
        $initials = array_shift($nameArray);

        $customer = Customer::query()->firstOrCreate(
            [
                'initials' => $initials,
                'lastname' => join(' ', $nameArray)
            ]
        );

        $this->customerIdMap[$customerName] = $customer->id;

        return $customer->id;
    }

    public function getEmployeeId(string $employeeName): int
    {
        if (isset($this->employeeIdMap[$employeeName])) {
            return $this->employeeIdMap[$employeeName];
        }

        $employee = Employee::query()->firstOrCreate(
            [
                'name' => $employeeName
            ]
        );

        $this->employeeIdMap[$employeeName] = $employee->id;

        return $employee->id;
    }

    public function getOfficeId(string $officeName): int
    {
        if (isset($this->officeIdMap[$officeName])) {
            return $this->officeIdMap[$officeName];
        }

        $office = Office::query()->firstOrCreate(
            [
                'name' => $officeName
            ]
        );

        $this->officeIdMap[$officeName] = $office->id;

        return $office->id;
    }

    public function rules(): array
    {
        return config('order-import.rules', []);
    }
}
