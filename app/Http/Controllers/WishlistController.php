<?php

namespace App\Http\Controllers;
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;

class WishlistController extends Controller
{
    public function show($id, Request $request)
    {
        $wishlist = User::find($id)->wishlist;

        $productIds = []; // Collect product IDs from the cart
        foreach ($wishlist as $wishlistItem) {
            $productIds[] = $wishlistItem;
        }

        // Fetch products based on the collected product IDs
        $products = Product::whereIn('_id', $productIds)->get();

        // Associate product information with the cart items
        foreach ($wishlist as &$wishlistItem) {
            $productId = $wishlistItem;
            $product = $products->where('_id', $productId)->first();

            $wishlistItem = $product; // Attach product information
        }

        // error_log(implode(end($wishlist)->price_history));
        return view('wishlist', [
            'wishlist' => $wishlist,
        ]);
    }
    public function store(Request $request){
        $user = User::find($request->user()->id);
        $productId = new ObjectId($request->product_id);
        if (!in_array($productId, $user->wishlist)) {
            $user->push('wishlist', $productId);
            Product::find($request->product_id)->increment('wishlist_count');
        }
        return response()->json(["result" => "ok"], 201);
    }
    public function destroy($wishlistItemId)
    {
        $user = User::find(auth()->user()->id);
        $productId = new ObjectId($wishlistItemId);

        if (in_array($productId, $user->wishlist)) {
            $user->pull('wishlist', $productId);
            Product::find($wishlistItemId)->decrement('wishlist_count');
        }

        return response()->json(["result" => "ok"], 204);
    }

}
