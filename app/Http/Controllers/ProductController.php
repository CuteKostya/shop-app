<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $products = Product::query()
            ->leftJoin('baskets', function ($join) use ($userId) {
                $join->on('products.id', '=', 'baskets.product_id')
                    ->where('baskets.user_id', $userId);
            })
            ->select('products.id', 'products.name', 'products.description',
                'products.price', 'baskets.count')
            ->get();

        return view('products.index', compact('products'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::query()->where('id', '=', $id)
            ->first();
        return view('products.show', compact('product'));
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
        $user = Auth::user();
        $userId = $user->id;
        $product = Basket::query()
            ->where('product_id', $id)
            ->where('user_id', '=', $userId)->first();
        if ($request->input('action') == 'increase') {
            $product->count++;
            $product->save();
        } elseif ($request->input('action') == 'decrease') {
            $product->count--;
            $product->save();
            if ($product->count <= 0) {
                $product->delete();
            }
        }


        return redirect()->route('products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}