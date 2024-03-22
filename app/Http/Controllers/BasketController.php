<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $products = Basket::query()
            ->leftJoin('products', 'baskets.product_id', '=',
                'products.id')->where('user_id', '=', $userId)->get();

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
        $count = 0;
        $user = Auth::user();
        $userId = $user->id;
        $existsProduct = Basket::where('product_id', '=', $request->productId)
            ->where('user_id', '=', $userId)
            ->exists();


        if ( ! $existsProduct) {
            $count = 1;
            $user = Auth::user();
            $userId = $user->id;
            Basket::query()->create([
                'product_id' => $request->productId,
                'user_id' => $userId,
                'count' => $count,
            ]);
        } else {
            $product = Basket::query()
                ->where('product_id', '=', $request->productId)
                ->get('count');
            $count = $product->value('count') + 1;

            Basket::query()
                ->where('product_id', '=', $request->productId)
                ->update(['count' => $count]);
        }
        Cache::delete('countProducts:'.$userId);
        $request->merge(['count' => $count]);
        return response()->json($request->all());
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
        $user = Auth::user();
        $userId = $user->id;
        $res = Basket::where('product_id', $id)
            ->delete();

        return redirect()->route('basket');
    }

    public function destroyAll(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $res = Basket::where('user_id', '=', $userId)
            ->delete();

        return redirect()->route('basket');
    }
}
