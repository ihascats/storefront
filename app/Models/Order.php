<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      'author_id',
      'coupon',
      'items',
      'status',
    ];
}
