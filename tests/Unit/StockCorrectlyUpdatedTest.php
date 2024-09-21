<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockCorrectlyUpdatedTest extends TestCase
{
    use RefreshDatabase;

    public function testIsStockCorrectlyUpdated()
    {
        $ingredient1 = Ingredient::factory()->create(['name'=>'test 1 ', 'current_amount' => 100, 'initial_amount' => 100]);
        $ingredient2 = Ingredient::factory()->create(['name'=>'test 2', 'current_amount' => 100, 'initial_amount' => 100]);

        $product = Product::factory()->create();
        $product->ingredients()->attach($ingredient1->id, ['amount' => 10]);
        $product->ingredients()->attach($ingredient2->id, ['amount' => 20]);

        $orderData = [
            'products' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                ],
            ],
        ];

        $response = $this->json('POST', '/api/order', $orderData);
        $response->assertStatus(201);
        $ingredient1->refresh();
        $ingredient2->refresh();

        $this->assertEquals(100 - (2 * 10), $ingredient1->current_amount); // 100 - (2 * 10) = 80
        $this->assertEquals(100 - (2 * 20), $ingredient2->current_amount); // 100 - (2 * 20) = 60
    }
}
