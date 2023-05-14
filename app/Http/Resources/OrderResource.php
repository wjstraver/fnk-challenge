<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => $this->product,
            'createdAt' => $this->created_at,
            'office' => $this->whenLoaded('office', fn() => OfficeResource::make($this->office)),
            'customer' => $this->whenLoaded('customer', fn() => CustomerResource::make($this->customer)),
            'employee' => $this->whenLoaded('employee', fn() => EmployeeResource::make($this->employee)),
        ];
    }
}
