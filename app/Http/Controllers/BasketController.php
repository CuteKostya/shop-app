<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Basket::query()
            ->leftJoin('products', 'baskets.products_id', '=',
                'products.id')->get();

        return view('basket.index', compact('products'));
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
        $existsProduct = Basket::where('products_id', '=', $request->id)
            ->exists();


        if ( ! $existsProduct) {
            Basket::query()->create([
                'products_id' => $request->id,
                'count' => 1,
            ]);
        } else {
            $product = Basket::query()
                ->where('products_id', '=', $request->id)
                ->get('count');
            $count = $product->value('count') + 1;

            Basket::query()
                ->where('products_id', '=', $request->id)
                ->update(['count' => $count]);
        }

        return redirect()->route('products');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $res = Basket::where('products_id', $id)->delete();

        return redirect()->route('basket');
    }

    public function destroyAll(Request $request)
    {
        $res = Basket::truncate();

        return redirect()->route('basket');
    }
}
