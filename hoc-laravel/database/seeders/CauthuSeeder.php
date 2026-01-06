<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cauthu;
class CauthuSeeder extends Seeder
{
    public function run(): void
    {
        Cauthu::create([
            'name' => 'Nguyễn Văn A',
            'age' => 22,
            'salary' => 15000000,
            'image' => null,
        ]);

        Cauthu::create([
            'name' => 'Nguyễn Văn B',
            'age' => 25,
            'salary' => 20000000,
            'image' => null,
        ]);
    }
}
