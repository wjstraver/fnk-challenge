<?php

namespace Tests\Unit\Imports;

use App\Imports\OrderImport;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Office;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Tests\TestCase;

class OrderImportTest extends TestCase
{
    protected OrderImport $import;

    protected function setUp(): void
    {
        parent::setUp();

        $this->import = new OrderImport();
    }

    /** @test */
    public function it_can_import_an_order_and_create_the_relations(): void
    {
        $id = 42;
        $product = 'abcd';
        $vestiging_verkoper = 'city / employee';
        $koper = 'customer';
        $datum_tijd = '08/04/2020 16:30';

        $order = $this->import->model(compact('id', 'product', 'vestiging_verkoper', 'koper', 'datum_tijd'));

        $this->assertEquals($id, $order->id);
        $this->assertEquals($product, $order->product);
        $this->assertInstanceOf(Carbon::class, $order->created_at);
        $this->assertEquals($datum_tijd, $order->created_at->format('d/m/Y H:i'));

        $this->assertInstanceOf(Customer::class, $order->customer);
        $this->assertEquals($koper, $order->customer->name);

        $this->assertInstanceOf(Office::class, $order->office);
        $this->assertEquals('city', $order->office->name);

        $this->assertInstanceOf(Employee::class, $order->employee);
        $this->assertEquals('employee', $order->employee->name);
    }

    /** @test */
    public function it_implements_required_concerns(): void
    {
        $this->assertInstanceOf(WithHeadingRow::class, $this->import);
        $this->assertInstanceOf(ToModel::class, $this->import);
        $this->assertInstanceOf(WithValidation::class, $this->import);
        $this->assertInstanceOf(SkipsOnFailure::class, $this->import);
    }

    /** @test */
    public function it_finds_and_only_creates_once_a_customer_by_name(): void
    {
        $id = $this->import->getCustomerId('a.b. test name');

        $this->assertTrue(
            Customer::query()
                ->where('id', $id)
                ->where('initials', 'a.b.')
                ->where('lastname', 'test name')
                ->exists()
        );

        $idTwo = $this->import->getCustomerId('a.b. test name');

        $this->assertEquals($id, $idTwo);
    }

    /** @test */
    public function it_finds_and_only_creates_once_an_employee_by_name(): void
    {
        $id = $this->import->getEmployeeId('employee name');

        $this->assertTrue(
            Employee::query()
                ->where('id', $id)
                ->where('name', 'employee name')
                ->exists()
        );

        $idTwo = $this->import->getEmployeeId('employee name');

        $this->assertEquals($id, $idTwo);
    }

    /** @test */
    public function it_finds_and_only_creates_once_an_office_by_name(): void
    {
        $id = $this->import->getOfficeId('office name');

        $this->assertTrue(
            Office::query()
                ->where('id', $id)
                ->where('name', 'office name')
                ->exists()
        );

        $idTwo = $this->import->getOfficeId('office name');

        $this->assertEquals($id, $idTwo);
    }

    /** @test */
    public function it_returns_rules_from_config(): void
    {
        $rules = [
            'a' => 'b'
        ];
        $this->app['config']->set('order-import.rules', $rules);

        $this->assertEquals($rules, $this->import->rules());
    }
}
