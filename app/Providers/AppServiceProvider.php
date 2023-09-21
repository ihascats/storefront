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
        $items = Product::all('categories', 'variants');
        $combinedCategories = [];
        $minPrice = PHP_INT_MAX; // Initialize min price as a high value
        $maxPrice = 0; // Initialize max price as a low value
        $sizes = [];
        $colors = [];

        foreach ($items as $item) {
            $categories = $item->categories;
            $combinedCategories = array_merge($combinedCategories, $categories);

            // Collect sizes and colors from variants
            foreach ($item->variants as $variant) {
                // Calculate the potential discounted price
                $basePrice = $variant['price'];
                $discount = $variant['discount'] ?? 0; // If discount is not set, default to 0
                $discountStartDate = $variant['discount_start_date'];
                $discountExpDate = $variant['discount_exp_date'];
                $now = now();

                // Calculate the discounted price
                if ($discount > 0 && $now >= $discountStartDate->toDateTime() && $now <= $discountExpDate->toDateTime()) {
                    $discountedPrice = $basePrice - ($basePrice * $discount / 100);
                    $discountedPrice = number_format($discountedPrice, 2);
                } else {
                    $discountedPrice = $basePrice;
                }

                // Update min and max prices
                $minPrice = min($minPrice, $discountedPrice);
                $maxPrice = max($maxPrice, $discountedPrice);

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
