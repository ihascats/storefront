<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use MongoDB\BSON\UTCDateTime;

class ProductController extends Controller
{
  public function search(Request $request){

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
        $query->whereBetween('price_details.price', [$minPrice, $maxPrice]);
    }


    // Categories
    if ($request->has('categories')) {
      $categories = $request->input('categories');
      $query->where(function ($query) use ($categories) {
        foreach ($categories as $category) {
            $query->where('categories', 'all', [$category]);
        }
      });
    }

    // // Sizes
    if ($request->has('sizes')) {
        $sizes = $request->input('sizes');
        $query->where(function ($query) use ($sizes) {
          foreach ($sizes as $size) {
              $query->where('variants.0.sizes', $size);
          }
        });
    }

    // // Colors
    if ($request->has('colors')) {
        $colors = $request->input('colors');
        $query->where(function ($query) use ($colors) {
            foreach ($colors as $color) {
                $query->where('variants.0.color', $color);
            }
        });
    }

    // Execute the query
    $products = $query->get();
    
    if (count($products) === 0){
      // should show user that theres 0 matches for this query
    }
    return view('products', [
      'allProducts' => $products,
      'request' => $request
    ]);
  }
  public function index(){
    $allProducts = Product::all();
    return view('products', [
      'allProducts' => $allProducts,
    ]);
  }
  public function create() {
    $items = Product::all('categories');
    $combinedCategories = [];
    foreach ($items as $item) {
      $categories = $item->categories;
      $combinedCategories = array_merge($combinedCategories, $categories);
    }

    $uniqueCombinedCategories = array_unique($combinedCategories);
    return view('product_create', [
      'categories' => $uniqueCombinedCategories,
    ]);
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
    $price = $product->price_details['price'];
    // $reviews = Reviews::where('product_id', '=', $product->id);
    // $rating = array_sum(Reviews::where('product_id', '=', $product->id)->avg('rating'));

    return view('product', [
        'product' => $product,
        'total_quantity' => $total_quantity,
        'price' => $price
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
    //  [
      //    {
        //      price: int
        //      date: date 
        //      discount: bool
        //    },
        //    ...
        //  ]
    $request->price !== null ? $product->price_details["price"] = $request->price : null; //
    $request->currency !== null ? $product->price_details["currency"] = $request->currency : null; // 
    $request->discount !== null ? $product->price_details["discount"] = $request->discount : null; // 
    $request->discount_exp_date !== null ? $product->price_details["discount_exp_date"] = $request->discount_exp_date : null; // 
    // {
    //    discount: int
    //    expiration_date: date
    // }
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
    $currentVar = null;

    foreach($request->variants as $variant){
      if (isset($variant['color'])) {
          if ($currentVar !== null) {
              $combinedVariations[] = $currentVar;
          }
          $currentVar['color'] = $variant['color'];
      } elseif (isset($variant['quantity'])) {
          $currentVar['quantity'] = intval($variant['quantity']);
      } elseif (isset($variant['sizes'])) {
          $currentVar['sizes'] = $variant['sizes'];
      }
    }
    if ($currentVar !== null) {
        $combinedVariations[] = $currentVar;
    }

    // Get the user's selected local time as a string from the input
    $discountExpDateLocalTime = $request->discount_exp_date;

    // Convert the local time to a DateTime object
    $discountExpDateLocalDateTime = new DateTime($discountExpDateLocalTime, new DateTimeZone($request->localTimezone));

    // Convert the local DateTime to UTC DateTime
    $discountExpDateUtcDateTime = $discountExpDateLocalDateTime->setTimezone(new DateTimeZone('UTC'));

    // Create a UTCDateTime object for MongoDB
    $discountExpDate = new UTCDateTime($discountExpDateUtcDateTime->getTimestamp() * 1000);
    

    // Get the user's selected local time as a string from the input
    $discountStartDateLocalTime = $request->discount_start_date;

    // Convert the local time to a DateTime object
    $discountStartDateLocalDateTime = new DateTime($discountStartDateLocalTime, new DateTimeZone($request->localTimezone));

    // Convert the local DateTime to UTC DateTime
    $discountStartDateUtcDateTime = $discountStartDateLocalDateTime->setTimezone(new DateTimeZone('UTC'));

    // Create a UTCDateTime object for MongoDB
    $discountStartDate = new UTCDateTime($discountStartDateUtcDateTime->getTimestamp() * 1000);

    if ($discountStartDate > $discountExpDate) {
        $discountExpDate = $discountStartDate;
    }

    Product::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'description' => $request->description,
        'specifications' => $combinedSpecifications,
        'price_details' => [
            'price' => floatval($request->price),
            'currency' => $request->currency,
            'discount' => $request->discount,
            'discount_start_date' => $discountStartDate,
            'discount_exp_date' => $discountExpDate,
        ],
        'wishlist_count' => 0,
        'categories' => $request->categories,
        'variants' => $combinedVariations,
    ]);

    return response()->json(["result" => "ok"], 201);
  }

}
