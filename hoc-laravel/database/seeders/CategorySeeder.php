<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Áo nam',
                'slug' => 'ao-nam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Quần nam',
                'slug' => 'quan-nam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Áo nữ',
                'slug' => 'ao-nu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Quần nữ',
                'slug' => 'quan-nu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Giày dép',
                'slug' => 'giay-dep',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Phụ kiện',
                'slug' => 'phu-kien',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
