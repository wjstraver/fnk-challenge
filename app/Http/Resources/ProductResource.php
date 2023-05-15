<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'link' => route('products.show', ['product' => $this->product]),
            'ID' => $this->product,
            __('Product') => $this->product,
            __('Times Sold') => $this->sale_count ?? 0
        ];
    }
}
