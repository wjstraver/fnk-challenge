<?php

namespace Database\Seeders;

use App\Imports\OrderImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path = config('order-import.default_file');
        if (file_exists($path)) {
            Excel::import(new OrderImport(), $path);
        }
    }
}
