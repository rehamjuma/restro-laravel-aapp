<?php

namespace Tests\Unit;
use Tests\TestCase;


class CreateOrderTest extends TestCase
{
    /**
     * test create order happy scenario
     */
    public function testCreateOrder(): void
    {
        $data  = [
            "products"=> [
                [
                    'product_id' => 2,
                    'quantity' => 2,
                ]
            ]];
        $response = $this->json('POST', '/api/order', $data);
        $response->assertStatus(201);
        $response->assertJson(['message'=> "Order created successfully"]);
        $response->assertJsonStructure(['order' => [
                'id',
                'created_at',
                'updated_at'
        ]]);
       
    }




}
