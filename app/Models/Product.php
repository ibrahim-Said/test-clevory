<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'title',
        'category',
        'description',
        'price',
        'image',
        'rating_rate',
        'rating_count'
    ];
}
