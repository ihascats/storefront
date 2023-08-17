<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show($id, Request $request){
        $userCart = User::find($id)->cart ?? [];

        $productIds = []; // Collect product IDs from the cart
        foreach ($userCart as $cartItem) {
            $productIds[] = $cartItem['product_id'];
        }

        // Fetch products based on the collected product IDs
        $products = Product::whereIn('_id', $productIds)->get();

        // Associate product information with the cart items
        foreach ($userCart as &$cartItem) {
            $productId = $cartItem['product_id'];
            $product = $products->where('_id', $productId)->first();

            $cartItem['product'] = $product; // Attach product information
        }

        return view('cart', [
            'cart' => $userCart,
        ]);
    }

    public function store(Request $request) {

        $newProduct = [
            "product_id" => new ObjectId($request->product_id),
            "quantity" => intval($request->quantity)
        ];

        $user_id = $request->user()->id;
        $user = User::find($user_id);

        $productInCart = null;
        $cart = $user->cart ?? [];

        foreach ($cart as $index => $product) {
            if ($product["product_id"] == $newProduct["product_id"]) {
                $productInCart = $index;
                break;
            }
        }

        if ($productInCart === null) {
            $user->push('cart', $newProduct);
            return response()->json(["result" => "ok, added item to cart"], 204);
        } else {
            $cart[$productInCart]["quantity"] += $newProduct["quantity"];
            $user->cart = $cart;
            $user->save();
            return response()->json(["result" => "ok, increased quantity"], 204);
        }
    }
    public function delete($product_id, Request $request){
        $user = $request->user();
        User::find($user->id)->pull('cart', [
            "product_id" => new ObjectId($product_id), // Should be objectID
            "quantity" => intval($request->quantity)
        ]);
        return response()->json(["result" => "ok, removed item from cart"], 204);
    }

    public function updateCartItemQuantity(Request $request) {

        $product_id = new ObjectId($request->product_id);
        $quantity = intval($request->quantity);

        $user_id = $request->user()->id;
        $user = User::find($user_id);

        $cart = $user->cart ?? [];
        $productInCartIndex = null;

        foreach ($cart as $index => $product) {
            if ($product["product_id"] == $product_id) {
                $productInCartIndex = $index;
                break;
            }
        }

        if ($productInCartIndex !== null) {
            $cart[$productInCartIndex]["quantity"] = $quantity;
            $user->cart = $cart;
            $user->save();
            return response()->json(["result" => "ok, updated quantity"], 204);
        } else {
            return response()->json(["result" => "Product not found in cart"], 404);
        }
    }

}
