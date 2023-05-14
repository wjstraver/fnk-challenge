<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'orderCount' => $this->whenCounted('orders', fn() => $this->orders_count),
            'orders' => $this->whenLoaded('orders', fn() => OrderResource::collection($this->orders))
        ];
    }
}
