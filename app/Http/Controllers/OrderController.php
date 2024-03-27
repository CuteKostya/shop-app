<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Mail\User\OrderMail;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $orders = Order::query()->where('user_id', '=', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

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

                'order_id' => $order->id,
                'product_id' => $product->product_id,
                'count' => $product->count,
            ]);
            $order_item->save();
        }

        Basket::where('user_id', '=', $userId)
            ->delete();
        Cache::delete('countProducts:'.$userId);
        $products = Order_item::query()
            ->leftJoin('products', 'Order_items.product_id', '=', 'products.id')
            ->where('order_id', '=', $order->id)->get();
        Mail::to('k.kudishin421421@yandex.ru')->send(new OrderMail($products,
            $user));

        Log::channel('daily')
            ->info('User {user_id} created a new order {order_id}',
                [
                    'user_id' => $userId,
                    'order_id' => $order->id,
                ]
            );
        return redirect()->route('basket');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = Auth::user();
        $userId = $user->id;
        $products = Order_item::query()
            ->leftJoin('products', 'Order_items.product_id', '=', 'products.id')
            ->where('order_id', '=', $id)->get();


        return view('order.show', compact('products'));
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        return (new OrdersExport($userId))->download('invoices.xlsx');
    }
}
