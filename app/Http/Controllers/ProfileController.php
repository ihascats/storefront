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
    public function addToCart(Request $request){
        $user = $request->user();
        User::find($user->id)->push('cart', [
            "product_id" => new ObjectId($request->product_id), // Should be objectID
            "quantity" => intval($request->quantity)
        ]);
        return response()->json(["result" => "ok, added item to cart"], 204);
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
