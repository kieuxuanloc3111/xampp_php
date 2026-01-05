<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'slug'];

    // category có nhiều product
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
