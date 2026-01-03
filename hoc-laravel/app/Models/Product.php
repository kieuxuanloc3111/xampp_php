<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'quantity',
        'price',
        'rating',
        'is_active',
        'status',
        'category_id',
        'extra_info',
        'publish_date',
        'expired_at',
    ];

    // quan hệ: product thuộc về category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
