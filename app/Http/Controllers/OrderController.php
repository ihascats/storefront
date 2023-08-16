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
    public function show(){

    }
    public function store(Request $request){
        $userId = $request->user()->id;
        $user = User::find($userId);
        Order::create([
            'author_id' => new ObjectId($userId),
            'products' => $user->cart ?? [],
        ]);

        return response()->json(["result" => "ok"], 201);
    }
    public function update(){

    }
    public function destroy($id){
        Order::find($id)->delete();
        return response()->json(["result" => "ok, deleted"], 204);
    }
}
