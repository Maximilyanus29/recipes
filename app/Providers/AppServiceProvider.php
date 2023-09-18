<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        view()->composer('layouts.base', function($view)
        {
            $ingredients = DB::table("ingredient")->get();
            $categories = DB::table("category")->get();

            $view->with('ingredients', $ingredients);
            $view->with('categories', $categories);
            $view->with('filters', Session::get('filters') ?: []);
        });
    }
}
