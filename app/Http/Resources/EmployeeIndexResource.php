<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'link' => route('employees.show', ['employee' => $this->id]),
            'ID' =>  $this->id,
            __('Name') => $this->name,
            __('Sold Orders') => $this->whenCounted('orders', fn() => $this->orders_count)
        ];
    }
}
