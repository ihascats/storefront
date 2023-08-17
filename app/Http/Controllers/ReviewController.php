<?php

namespace App\Http\Controllers;
require_once __DIR__ . '/../../../vendor/autoload.php';
use MongoDB\BSON\ObjectId;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show($id)
    {
        $review = Review::where('id', '=', $id)->first();

        return view('review', [
            'review' => $review,
        ]);
    }
    public function store(Request $request){
        $userId = $request->user()->id;
        Review::create([
            'product_id' => new ObjectId($request->product_id),
            'author_id' => new ObjectId($userId),
            'review_text' => $request->review_text,
            'rating' => intval($request->rating)
        ]);

        return response()->json(["result" => "ok"], 201);
    }
}
