<?php

namespace App\Providers;

use App\Models\Basket;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //


//        if (Auth::check()) {
//            $total = 0;
//            View::share('countProducts', $total);
//        } else {
//            $user = Auth::user();
//
//
//            $userId = $user->id;
//            $total = Basket::query()
//                ->select(DB::raw('sum(count) as total'))
//                ->where('user_id', '=', $userId)
//                ->first()->total;
//            dd($total);
        Paginator::useBootstrapFive();
        View::share('countProducts', 0);
//        }
    }
}
