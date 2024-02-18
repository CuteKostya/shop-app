<?php

namespace App\Providers;

use App\Models\Basket;
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
        $total = Basket::query()
            ->select(DB::raw('sum(count) as total'))
            ->first()->total;
        View::share('countProducts', $total);
    }
}
