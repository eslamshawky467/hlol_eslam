<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'amount', 'type', 'status', 'start_at', 'end_at'];
    protected $dates = ['end_at'];
    protected $casts=[
        'amount' => 'integer',
    ];
}
