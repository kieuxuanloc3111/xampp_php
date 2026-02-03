<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'sale',
        'sale_price',
        'company',
        'detail',
        'status',      // 👈 thêm
        'category_id',
        'brand_id',
        'image',
        'user_id',
    ];


    protected $casts = [
        'image' => 'array', // tự động json_decode
    ];

    public $timestamps = true;

    /* ======================
        RELATIONSHIP
    ====================== */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Giá sau khi giảm
    public function getFinalPriceAttribute()
    {
        if ($this->sale_price > 0) {
            return $this->price - ($this->price * $this->sale_price / 100);
        }

        return $this->price;
    }

    // Kiểm tra có sale hay không
    public function getIsSaleAttribute()
    {
        return $this->sale_price > 0;
    }

}
