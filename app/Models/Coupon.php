<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'phrase',
      'quantity',
      'exp_date',
      'categories',
      'attributes',
      'price_range',
    ];
}
