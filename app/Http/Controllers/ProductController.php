<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use MongoDB\BSON\UTCDateTime;

class ProductController extends Controller
{
public function search(Request $request)
{
    $query = Product::query();

    $searchQuery = implode('%', explode(' ', trim($request->input('query'))));

    // Search Query
    if ($request->has('query') && trim($request->input('query')) !== '') {
        $query->where('name', 'like', '%' . $searchQuery . '%');
    }

    // Price Range
    if ($request->has('min-price') && $request->has('max-price')) {
        $minPrice = (float)$request->input('min-price');
        $maxPrice = (float)$request->input('max-price');

        // Consider discounts when filtering by price range
        $query->where(function ($query) use ($minPrice, $maxPrice) {
            $query->orWhere(function ($query) use ($minPrice, $maxPrice) {
                $query->where('variants.price', '>=', $minPrice)
                    ->where('variants.price', '<=', $maxPrice);
            });

            $query->orWhere(function ($query) use ($minPrice, $maxPrice) {
                // Filter by discounted price range
                $query->where('variants.discount_start_date', '<=', new UTCDateTime(now()->getTimestamp() * 1000))
                    ->where('variants.discount_exp_date', '>=', new UTCDateTime(now()->getTimestamp() * 1000))
                    ->where('variants.price - (variants.price * variants.discount / 100)', '>=', $minPrice)
                    ->where('variants.price - (variants.price * variants.discount / 100)', '<=', $maxPrice);
            });
        });
    }

    // Categories
    if ($request->has('categories')) {
        $categories = $request->input('categories');
        $query->whereIn('categories', $categories);
    }

    // Sizes
    if ($request->has('sizes')) {
        $sizes = $request->input('sizes');
        $query->where(function ($query) use ($sizes) {
            foreach ($sizes as $size) {
                $query->where('variants.sizes', $size);
            }
        });
    }

    // Colors
    if ($request->has('colors')) {
        $colors = $request->input('colors');
        $query->where(function ($query) use ($colors) {
            foreach ($colors as $color) {
                $query->where('variants.color', $color);
            }
        });
    }

    // Execute the query
    $products = $query->get();

    if ($products->isEmpty()) {
        // Show a message to the user indicating there are no matches for the query
    }
    $products->each(function ($product) {
        $lowestPrice = PHP_FLOAT_MAX;
        $highestPrice = PHP_FLOAT_MIN;

        foreach ($product->variants as $variant) {
            $basePrice = $variant["price"];
            $discount = $variant["discount"] ?? 0; // If discount is not set, default to 0
            $discountStartDate = $variant["discount_start_date"];
            $discountExpDate = $variant["discount_exp_date"];
            $now = now();

            // Calculate the discounted price
            if ($discount > 0 && $now >= $discountStartDate->toDateTime() && $now <= $discountExpDate->toDateTime()) {
                $discountedPrice = $basePrice - ($basePrice * $discount / 100);
                $discountedPrice = number_format($discountedPrice, 2);
            } else {
              $discountedPrice = $basePrice;
            }
            if ($discountedPrice < $lowestPrice) {
                $lowestPrice = $discountedPrice;
            }

            if ($discountedPrice > $highestPrice) {
                $highestPrice = $discountedPrice;
            }
        }

        $product->lowest_price = $lowestPrice;
        $product->highest_price = $highestPrice;
    });

    return view('products', [
        'allProducts' => $products,
        'request' => $request,
    ]);
}

  public function index()
  {
      $allProducts = Product::all();

      // Calculate lowest and highest prices for each product, considering ongoing discounts
      $allProducts->each(function ($product) {
          $lowestPrice = PHP_FLOAT_MAX;
          $highestPrice = PHP_FLOAT_MIN;

          foreach ($product->variants as $variant) {
              $basePrice = $variant["price"];
              $discount = $variant["discount"] ?? 0; // If discount is not set, default to 0
              $discountStartDate = $variant["discount_start_date"];
              $discountExpDate = $variant["discount_exp_date"];
              $now = now();

              // Calculate the discounted price
              if ($discount > 0 && $now >= $discountStartDate->toDateTime() && $now <= $discountExpDate->toDateTime()) {
                  $discountedPrice = $basePrice - ($basePrice * $discount / 100);
                  $discountedPrice = number_format($discountedPrice, 2);
              } else {
                $discountedPrice = $basePrice;
              }
              if ($discountedPrice < $lowestPrice) {
                  $lowestPrice = $discountedPrice;
              }

              if ($discountedPrice > $highestPrice) {
                  $highestPrice = $discountedPrice;
              }
          }

          $product->lowest_price = $lowestPrice;
          $product->highest_price = $highestPrice;
      });

      return view('products', [
          'allProducts' => $allProducts,
      ]);
  }


  public function create() {
    return view('product_create');
  }

  public function show($slug)
  {
    //  AGGREGATIONS
    //  -----------------------------
    //  total_quantity get 
    //  rating
    //  price
    //  reviews
    //  -----------------------------
    $product = Product::where('slug', '=', $slug)->first();
    $total_quantity = array_sum($product::max('variants.quantity'));
    // $reviews = Reviews::where('product_id', '=', $product->id);
    // $rating = array_sum(Reviews::where('product_id', '=', $product->id)->avg('rating'));

    return view('product', [
        'product' => $product,
        'total_quantity' => $total_quantity,
    ]);
  }

  public function destroy($id)
  {
    Product::find($id)->delete();
    return response()->json(["result" => "ok, deleted"], 204);
  }

  public function update($id, Request $request)
  {
    $product = Product::find($id);

    $request->name !== null ? $product->name = $request->name : null; // STRING
    $request->slug !== null ? $product->slug = $request->slug : null; // STRING
    $request->description !== null ? $product->description = $request->description : null; // STRING
    $request->specifications !== null ? $product->specifications = $request->specifications : null; // 
    //  [ 
    //    {
    //      name: string
    //      description: string
    //    },
    //    ...
    //  ]
    $request->wishlist_count !== null ? $product->wishlist_count = $request->wishlist_count : null; // increment / decrement when user adds to a wishlist / removes from
    $request->categories !== null ? $product->categories = $request->categories : null; // list of categories the product belongs to
    //  [
    //    monitor,
    //    gaming,
    //    oled,
    //    ...
    //  ]
    $request->variants !== null ? $product->variants = $request->variants : null; // list of objects as described below
    //  [{red: {
    //    quantity: int
    //    sizes: [s, m, l, xl, xxl]
    //  }}, ...]

    //  AGGREGATIONS
    //  -----------------------------
    //  total_quantity get 
    //  rating
    //  price
    //  reviews
    //  -----------------------------

    $product->save();

    return response()->json(["result" => "ok, updated"], 200);
  }

  public function store(Request $request)
  {
    $combinedSpecifications = [];
    $currentSpec = null;
    if(isset($request->specifications)) {
      foreach ($request->specifications as $spec) {
          if (isset($spec['name'])) {
              if ($currentSpec !== null) {
                  $combinedSpecifications[] = $currentSpec;
              }
              $currentSpec = ['name' => $spec['name']];
          } elseif (isset($spec['description'])) {
              $currentSpec['description'] = $spec['description'];
          }
      }

      if ($currentSpec !== null) {
          $combinedSpecifications[] = $currentSpec;
      }
    }

    // Now $combinedSpecifications contains the grouped specifications
    $combinedVariations = [];

    function setDateTime($dateLocalTime, $localTimezone) {
        $formatLocalDateTime = new DateTime($dateLocalTime, new DateTimeZone($localTimezone));

        // Convert the local DateTime to UTC DateTime
        $formatLocalDateTimeToUtc = $formatLocalDateTime->setTimezone(new DateTimeZone('UTC'));

        // Return a UTCDateTime object for MongoDB
        return new UTCDateTime($formatLocalDateTimeToUtc->getTimestamp() * 1000);
    }

    foreach($request->variants as  $index=>$variant) {
        $discountStartDate = setDateTime($variant['discount_start_date'], $request->localTimezone);
        $discountExpDate = setDateTime($variant['discount_exp_date'], $request->localTimezone);

        $imagesArray = [];
        foreach ($variant['images'] as $image) {
            $imagesArray[] = 'storefront/' . $request->slug . '/' . $index . '/' . $image;
        }

        $variant = [
            'images' => $imagesArray,
            'price' => floatval($variant['price']),
            'currency' => $variant['currency'],
            'discount' => intval($variant['discount']),
            'discount_start_date' => $discountStartDate,
            'discount_exp_date' => $discountExpDate,
            'color' => $variant['color'],
            'sizes' => $variant['sizes'],
            'quantity' => intval($variant['quantity']),
        ];

        $combinedVariations[] = $variant;
    }
    print_r($combinedVariations);
    Product::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'description' => $request->description,
        'specifications' => $combinedSpecifications,
        'wishlist_count' => 0,
        'categories' => $request->categories,
        'variants' => $combinedVariations,
    ]);

    return response()->json(["result" => "ok"], 201);
  }

}
