<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'link' => route('customers.show', ['customer' => $this->id]),
            'ID' => $this->id,
            __('Initials') => $this->initials,
            __('Lastname') => $this->lastname,
            __('Orders') => $this->whenCounted('orders', fn() => $this->orders_count)
        ];
    }
}
