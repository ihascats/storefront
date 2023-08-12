<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function show($author_id)
    {
        $wishlist = Wishlist::where('author_id', '=', $author_id)->first();

        return view('wishlist', [
            'wishlist' => $wishlist,
        ]);
    }
}
