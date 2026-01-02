<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
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
        ]);
    }
}
