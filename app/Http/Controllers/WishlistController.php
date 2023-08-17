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
        $user->push('wishlist', new ObjectId($request->product_id));

        return response()->json(["result" => "ok"], 201);
    }
    public function destroy($wishlistItemId)
    {
        $user = User::find(auth()->user()->id);
        $user->pull('wishlist', new ObjectId($wishlistItemId));

        return response()->json(["result" => "ok"], 204);
    }

}
