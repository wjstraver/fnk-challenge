<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'link' => route('offices.show', ['office' => $this->id]),
            'ID' =>  $this->id,
            __('Name') => $this->name,
            __('Sold Orders') => $this->whenCounted('orders', fn() => $this->orders_count)
        ];
    }
}
