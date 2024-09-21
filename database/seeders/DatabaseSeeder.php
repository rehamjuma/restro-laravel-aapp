<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Ingredient::insert([
            [
                'name'=>'Beef',
                'current_amount'=>20000,
                'initial_amount'=>20000,
                'created_at'=>now()->format('Y-m-d H:i:s')
            ],
            [
                'name'=>'Cheese',
                'current_amount'=>5000,
                'initial_amount'=>5000,
                'created_at'=>now()->format('Y-m-d H:i:s')
            ],
            [
                'name'=>'Onion',
                'current_amount'=>1000,
                'initial_amount'=>1000,
                'created_at'=>now()->format('Y-m-d H:i:s')
            ]
        ]);
        
        $product = Product::create(
            [
                'name'=>'Burger',
            ]
        );

        DB::table('product_ingredient')->insert([
            [
                'product_id' => $product->id,
                'ingredient_id' => 1, // Beef
                'amount' => 150,
                'created_at'=>now()->format('Y-m-d H:i:s')
            ],
            [
                'product_id' => $product->id,
                'ingredient_id' => 2, // Cheese
                'amount' => 30,
                'created_at'=>now()->format('Y-m-d H:i:s')
            ],
            [
                'product_id' => $product->id, 
                'ingredient_id' => 3, // Onion
                'amount' => 20,
                'created_at'=>now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
