<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $query = Product::query()
            ->leftJoin('baskets', function ($join) use ($userId) {
                $join->on('products.id', '=', 'baskets.product_id')
                    ->where('baskets.user_id', $userId);
            })->where('withdrawn', false)
            ->select('products.id', 'products.grade', 'products.name',
                'products.description',
                'products.price', 'baskets.count');

        $ids = $query->pluck('id');

        $limit = 10;
        $products = $query->paginate($limit);

        foreach ($products as $product) {
            if ($product->count == null) {
                $product->count = 0;
            }
        }

        $images = Image::query()
            ->Join('products', 'products.id', '=', 'images.product_id')
            ->whereIn('products.id', $ids)
            ->select('images.id', 'images.url')->get();

        return view('products.index', compact('products', 'images'));
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
        $product = Product::query()->where('id', '=', $id)
            ->first();
        $comments = Comment::query()
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->where('product_id', '=', $id)
            ->orderBy('comments.updated_at', 'desc')
            ->get();

        return view('products.show', compact('product', 'comments'));
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
    public function update(Request $request)
    {
        $productId = $request->params['productId'];
        $user = Auth::user();
        $userId = $user->id;
        $product = Basket::query()
            ->where('product_id', $productId)
            ->where('user_id', '=', $userId)->first();
        $count = $product->count;
        if ($request->params['sign'] == 'increase') {
            $product->count++;
            $count++;
            $product->save();
        } elseif ($request->params['sign'] == 'decrease') {
            $product->count--;
            $count--;
            $product->save();
            if ($product->count <= 0) {
                $product->delete();
            }
        }
        $result = [
            'count' => $count,
        ];
        Cache::delete('countProducts:'.$userId);
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
