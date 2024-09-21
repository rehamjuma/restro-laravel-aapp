<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\CreateOrderEvent;
use App\Mail\IngredientAlertEmail;
use App\Events\SendAlertEmailEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateOrderRequest;

class OrderController extends Controller
{
    /**
     * function to handle creating new order
     */
    public function create(CreateOrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $order = Order::create();
            foreach($request->products as $orderProduct)
            {
                $product = Product::findOrFail($orderProduct['product_id']);
                $quantity = $orderProduct['quantity'];
                $productIngredients = $product->ingredients;
                foreach($productIngredients as $ingredient)
                {
                    $decresedAmount =  $ingredient->pivot['amount'] * $quantity;
                    if($ingredient->current_amount < $decresedAmount )
                    {
                        throw new \Exception("not enough amount of ingredient in the stock ".$ingredient->name );
                    }
                    $ingredient->current_amount = $ingredient->current_amount - $decresedAmount;
                    if($ingredient->current_amount  < $ingredient->initial_amount * 0.50 && !$ingredient->is_alert_email_sent )
                    {
                        event(new SendAlertEmailEvent($ingredient));
                    }
                    $ingredient->save();
                }

                $order->products()->attach( $product->id , ['quantity' => $quantity]);
                DB::commit();
                return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
