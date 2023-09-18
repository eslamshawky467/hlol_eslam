<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded=[];
    //protected $casts=[
     //   'amount' => 'integer',
    //];
    protected $dates = ['created_at'];
    protected $casts = [
        'parent_id' => 'integer',
        'order_id' => 'integer',
        'client_id'=>'integer',
        'price'=>'double',
        'unit_price'=>'double',
        'cost'=>'double',
        'quantity'=>'integer',
        'section_id'=>'integer',
        'children_id'=>'integer',
        'location_id'=>'integer',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function item()
    {
        return $this->belongsTo(Section::class,'parent_id');
    }
    public function items()
    {
        return $this->belongsTo(Section::class,'parent_id');
    }




}
