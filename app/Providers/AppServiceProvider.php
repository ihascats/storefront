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
        $items = Product::all('categories', 'price_details', 'variants', 'sizes');
        $combinedCategories = [];
        $minPrice = PHP_INT_MAX; // Initialize min price as a high value
        $maxPrice = 0; // Initialize max price as a low value
        $sizes = [];
        $colors = [];

        foreach ($items as $item) {
            $categories = $item->categories;
            $combinedCategories = array_merge($combinedCategories, $categories);

            // Update min and max prices
            $minPrice = min($minPrice, $item->price_details['price']);
            $maxPrice = max($maxPrice, $item->price_details['price']);

            // Collect sizes and colors
            foreach ($item->variants as $variant) {
                $sizes[] = $variant['sizes'];
                $colors[] = $variant['color'];
            }
        }

        $uniqueCombinedCategories = array_unique($combinedCategories);
        $uniqueSizes = array_unique($sizes);
        $uniqueColors = array_unique($colors);
        
        // Share the data with all views
        View::share([
            'categories' => $uniqueCombinedCategories,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sizes' => $uniqueSizes,
            'colors' => $uniqueColors,
        ]);
    }
}
