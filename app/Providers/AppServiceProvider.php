<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    public function boot()
    {
        // Retrieve the unique list of categories from the products
        $items = Product::all('categories');
        $combinedCategories = [];
        foreach ($items as $item) {
        $categories = $item->categories;
        $combinedCategories = array_merge($combinedCategories, $categories);
        }

        $uniqueCombinedCategories = array_unique($combinedCategories);
        
        // Share the categories with all views
        View::share('categories', $uniqueCombinedCategories);
    }
}
