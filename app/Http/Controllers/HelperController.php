<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    //
    public function index(Request $request)
    {
        $countProducts = null;
        if (Auth::check()) {
            $user = Auth::user();


            $userId = $user->id;
            $countProducts = Cache::rememberForever('countProducts:'.$userId,
                function () use ($userId) {
                    return Basket::query()
                        ->select(DB::raw('sum(count) as total'))
                        ->where('user_id', '=', $userId)
                        ->first()->total;
                });
        }

        return response()->json(['countProducts' => $countProducts]);
    }
}
