<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
      'author_id',
      'products',
    ];
}
