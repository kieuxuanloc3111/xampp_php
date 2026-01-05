<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CauthuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cauthu')->insert([
            [
                'name' => 'Nguyen Van A',
                'age' => 25,
                'salary' => 5000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Van B',
                'age' => 22,
                'salary' => 4500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Van C',
                'age' => 28,
                'salary' => 6000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
