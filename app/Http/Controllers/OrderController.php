<?php

namespace App\Http\Controllers;
require_once __DIR__ . '/../../../vendor/autoload.php';
use MongoDB\BSON\ObjectId;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function create(){
        
    }
    public function show($id){
        $order = Order::find($id);
        return view('order', [
            'order' => $order,
        ]);
    }
    public function store(Request $request){
        $userId = $request->user()->id;
        $user = User::find($userId);
        Order::create([
            'author_id' => new ObjectId($userId),
            'items' => $user->cart ?? [],
            'status' => "pending"
        ]);

        return response()->json(["result" => "ok"], 201);
    }
    public function update(Request $request, $orderId) {
        $user = $request->user();
        $newItems = $request->input('items'); // The new items array from the request

        // Find the order and update the items
        $order = Order::where('author_id', new ObjectID($user->id))
                    ->where('_id', new ObjectID($orderId))
                    ->first();

        if (!$order) {
            return response()->json(["error" => "Order not found"], 404);
        }

        // Update the items and save the order
        $order->items = $newItems;
        $order->save();

        return response()->json(["result" => "Order items updated"], 200);
    }
    public function destroy($id){
        Order::find($id)->delete();
        return response()->json(["result" => "ok, deleted"], 204);
    }
}
