<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    //protected $casts=[
     //   'amount' => 'integer',
    //];
    protected $casts = [
        'parent_id' => 'integer',
        'client_id'=>'integer',
        'price'=>'double',
        'cost'=>'double',
        'quantity'=>'integer',
        'coupon'=>'double',
        'location_id'=>'integer',
        'total_price'=>'double',


    ];
    protected $dates = ['created_at'];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
