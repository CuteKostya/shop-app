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
        $query = DB::table('basket');
        $products = $query->leftJoin('products', 'basket.products_id', '=',
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
        $products_id = $request->id;
        $booli = DB::table('basket')->where('products_id', '=', $products_id)
            ->exists();

        if ( ! $booli) {
            DB::table('basket')->insert([
                'products_id' => $products_id,
                'count' => 1,
            ]);
        } else {
            $product = DB::table('basket')
                ->where('products_id', '=', $products_id)->get('count');
            $count = $product->value('count') + 1;

            DB::table('basket')
                ->where('products_id', '=', $products_id)
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
    public function destroy(string $id)
    {
        //
    }
}
