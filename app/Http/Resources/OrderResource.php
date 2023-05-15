<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'link' => route('orders.show', ['order' => $this->id]),
            'ID' => $this->id,
            __('Product') => $this->product,
            __('Created At') => $this->created_at->format('Y/m/d H:i'),
            __('Customer') => $this->whenLoaded('customer', fn() => $this->customer->name),
            __('Employee') => $this->whenLoaded('employee', fn() => $this->employee->name),
            __('Office') => $this->whenLoaded('office', fn() => $this->office->name),
        ];
    }
}
