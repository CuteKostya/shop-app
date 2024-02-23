<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $userId = $user->id;

        $order = new Order();
        $order->user_id = $userId;
        $order->save();


        $products = Basket::all();

        foreach ($products as $product) {
            $order_item = new Order_item();

            $order_item->fill([

                'orders_id' => $order->id,
                'products_id' => $product->products_id,
                'count' => $product->count,
            ]);
            $order_item->save();
        }
        Basket::truncate();

        $products = Basket::all();


        return redirect()->route('basket');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $products = Order_item::query()
            ->leftJoin('products', 'Order_items.products_id', '=',
                'products.id')
            ->where('orders_id', '=', $id)->get();


        return view('order.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
