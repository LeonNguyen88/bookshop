<?php

namespace App\Providers;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        $categories = Category::where('parent_id', 0)->get();
        $sale_products = Product::orderBy('sale', 'desc')->take(8)->get();
        view()->share('categories', $categories);
        view()->share('sale_products', $sale_products);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
