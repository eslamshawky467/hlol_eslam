<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Used_Coupoun extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'coupon_id');
    }

}
