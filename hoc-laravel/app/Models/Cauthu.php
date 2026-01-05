<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cauthu extends Model
{
    protected $table = 'cauthu';

    protected $fillable = [
        'name',
        'age',
        'salary',
        'image', // 👈 thêm
    ];
}

