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

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function item()
    {
        return $this->belongsTo(Section::class,'parent_id');
    }

}
