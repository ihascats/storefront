<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
    Product::create([
      'name' => $request->name,
      'slug' => $request->slug,
      'description' => $request->description,
      'specifications' => [[
        'name' => $request->specification_name,
        'description' => $request->specification_description
      ]],
      'price_details' => [
        'price' => floatval($request->price),
        'currency' => $request->currency,
        'discount' => $request->discount,
        'discount_exp_date' => $request->discount_exp_date
      ],
      'wishlist_count' => 0,
      'categories' => $request->categories,
      'variants' => [[
        'color' => $request->variant_color,
        'quantity' => $request->variant_quantity,
        'sizes' => explode(', ', $request->variant_sizes),
      ]],
    ]);

    return response()->json(["result" => "ok"], 201);
  }

}
