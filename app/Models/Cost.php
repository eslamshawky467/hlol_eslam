<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $guarded = [];
    protected $casts = [
        'tax' => 'double',
        'delivery'=>'double',
    ];

}
