<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
    $array_of_prices = $product::max('price_history.price');
    $price = end($array_of_prices);
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
    $request->price_history !== null ? $product->price_history = $request->price_history : null; //
    //  [
    //    {
    //      price: int
    //      date: date 
    //      discount: bool
    //    },
    //    ...
    //  ]
    $request->discount !== null ? $product->discount = $request->discount : null; // 
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
    $product = new Product;

    $product->name = $request->name; // STRING
    $product->slug = $request->slug; // STRING
    $product->description = $request->description; // STRING
    $product->specifications = $request->specifications; // 
    //  [ 
    //    {
    //      name: string
    //      description: string
    //    },
    //    ...
    //  ]
    $product->price_history = $request->price_history; //
    //  [
    //    {
    //      price: int
    //      date: date 
    //      discount: bool
    //    },
    //    ...
    //  ]
    $product->discount = $request->discount; // 
    // {
    //    discount: int
    //    expiration_date: date
    // }
    $product->wishlist_count = $request->wishlist_count; // increment / decrement when user adds to a wishlist / removes from
    $product->categories = $request->categories; // list of categories the product belongs to
    //  [
    //    monitor,
    //    gaming,
    //    oled,
    //    ...
    //  ]
    $product->variants = $request->variants; // list of objects as described below
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

    return response()->json(["result" => "ok"], 201);
  }

}
