<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\ProductResource;
use stdClass;
use Tests\TestCase;

class ProductResourceTest extends TestCase
{
    /** @test */
    public function it_returns_a_product_with_sale_count(): void
    {
        $product = new stdClass();
        $product->product = 'test name';
        $product->sale_count = 42;

        $resource = new ProductResource($product);

        $result = $resource->toArray(request());

        $this->assertEquals('test name', $result['product']);
        $this->assertEquals(42, $result['saleCount']);
    }

    /** @test */
    public function it_will_return_zero_as_default_if_no_sale_count_available(): void
    {
        $product = new stdClass();
        $product->product = 'test name';

        $resource = new ProductResource($product);

        $result = $resource->toArray(request());

        $this->assertEquals(0, $result['saleCount']);
    }
}
