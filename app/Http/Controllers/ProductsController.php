<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::query()
            ->leftJoin('baskets', 'products.id', '=', 'baskets.products_id')
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
        if ($request->input('action') == 'increase') {
            $product = Basket::query()->where('products_id', $id)->first();

            $product->count++;
            $product->save();
        } elseif ($request->input('action') == 'decrease') {
            $product = Basket::query()->where('products_id', $id)->first();
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
