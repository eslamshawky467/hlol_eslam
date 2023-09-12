<?php

namespace App\Http\Controllers\Api\Order;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CoupounController extends Controller
{
    public function get_coupoun($code){
        $current_date_time = Carbon::now()->toDateTimeString();
        $c=Coupon::where('name',$code)->first();
        $end_at=$c->end_at;
    //    return $current_date_time;
      //  return $end_at;
        if($end_at->gte($current_date_time)){
            $coupon=Coupon::where('status','1')->where('name',$code)->first()->amount;
            return response()->json([
                'message' =>trans('auth.register.success'),
                 'item' => $coupon,
            ],200);
        }
        else
        return response()->json([
            'message' =>'coupon is expired or code is wrong',
        ],422);
    }
   }

