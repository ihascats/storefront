<?php

namespace App\Http\Controllers;
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use MongoDB\BSON\ObjectId;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function addToCart(Request $request) {

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
    public function removeFromCart(Request $request){
        $user = $request->user();
        User::find($user->id)->pull('cart', [
            "product_id" => new ObjectId($request->product_id), // Should be objectID
            "quantity" => intval($request->quantity)
        ]);
        return response()->json(["result" => "ok, removed item from cart"], 204);
    }
}
