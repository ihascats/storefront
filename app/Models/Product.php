<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    public function show($slug)
    {
        // get post that matches slug from mongodb
       return view('product', [
           'product' => Product::where('slug', '=', $slug)->first()
       ]);
    }
}
