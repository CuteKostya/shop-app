<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    //
    public function index(Request $request)
    {
        $countProducts = 0;
        if (Auth::check()) {
            $user = Auth::user();


            $userId = $user->id;
            $countProducts = Basket::query()
                ->select(DB::raw('sum(count) as total'))
                ->where('user_id', '=', $userId)
                ->first()->total;
        }

        return response()->json(['countProducts' => $countProducts]);
    }
}
