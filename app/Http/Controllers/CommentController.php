<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = Auth::user();
        $userId = $user->id;

        $comment = new Comment();
        $comment->product_id = $request->input('productId');
        $comment->description = $request->input('textComment');
        $comment->user_id = $userId;
        $comment->grade = $request->input('grade');
        $comment->save();

        $average = Comment::query()
            ->select(DB::raw('avg(comments.grade) as average'))
            ->where('product_id', '=', $request->input('productId'))
            ->first()->average;
        $prod = Product::where('id', '=', $request->input('productId'))
            ->first();
        $prod->grade = (double) $average;
        $prod->save();

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
    public function destroy(string $id)
    {
        //
    }
}
