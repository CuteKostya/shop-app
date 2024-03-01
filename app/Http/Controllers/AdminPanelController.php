<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = Product::query();
        $limit = 10;
        $products = $query->paginate($limit);

        return view('adminPanel.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('adminPanel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:150'],
            'price' => ['required', 'integer'],
        ]);


        $product = Product::query()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);
        $foo = $product;

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
        $product = Product::query()->where('id', $id)
            ->first();
        return view('adminPanel.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:150'],
            'price' => ['required', 'integer'],
        ]);
        Product::query()->where('id', '=', $id)->update($validated);

        return redirect()->route('adminPanel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->first();
        $product->update(['withdrawn' => ! $product->withdrawn]);


        $products = Basket::query()
            ->leftJoin('products', 'products.id', '=', 'baskets.product_id')
            ->where('withdrawn', true)
            ->where('products.id', $id)
            ->delete();

        return redirect()->route('adminPanel');
    }
}
