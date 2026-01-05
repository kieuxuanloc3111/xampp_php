<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                'name' => 'Áo thun nam basic',
                'slug' => 'ao-thun-nam-basic',
                'description' => 'Áo thun cotton, form regular.',
                'quantity' => 100,
                'price' => 199000,
                'rating' => 4.5,
                'is_active' => true,
                'publish_date' => now(),
                'expired_at' => null,
                'extra_info' => json_encode([
                    'color' => 'black',
                    'size' => ['M', 'L', 'XL']
                ]),
                'status' => 'published',
                'category_id' => 1, // phải tồn tại category 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quần jean xanh',
                'slug' => 'quan-jean-xanh',
                'description' => 'Quần jean co giãn nhẹ.',
                'quantity' => 50,
                'price' => 499000,
                'rating' => 4.2,
                'is_active' => true,
                'publish_date' => now(),
                'expired_at' => null,
                'extra_info' => json_encode([
                    'material' => 'denim',
                    'fit' => 'slim'
                ]),
                'status' => 'published',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
