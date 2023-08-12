<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    public function show($id)
    {
        $review = Review::where('id', '=', $id)->first();

        return view('review', [
            'review' => $review,
        ]);
    }
}
