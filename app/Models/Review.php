<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id',
        'author_id',
        'review_text',
        'rating',
    ];
}
