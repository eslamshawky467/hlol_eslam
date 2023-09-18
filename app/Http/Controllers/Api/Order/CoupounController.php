<?php

namespace App\Http\Controllers\Api\Order;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Used_Coupoun;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CoupounController extends Controller
{
    public function get_coupoun($code){
    if(Coupon::where('name', $code)->exists()){
        $c = Coupon::where('name', $code)->first();
        if(Used_Coupoun::where('client_id',auth()->guard('client')->user()->id)->where('coupon_id',$c->id)->exists()){
            return response()->json([
            'message' => 'الكود مستخدم من قبل ',
        ], 422);
       }
else{
if($c->status == '0'){
    return response()->json([
        'message' => 'coupon is expired',
    ], 422);
}
else{
    $current_date_time = Carbon::now()->toDateTimeString();
    $end_at = $c->end_at;
    //    return $current_date_time;
    //  return $end_at;
    if($end_at->gte($current_date_time)) {
        $coupon = Coupon::where('status', '1')->where('name', $code)->first()->amount;
        return response()->json([
            'message' => "success",
             'item' => $coupon,
        ], 200);
    } else {
        return response()->json([
            'message' => 'coupon is expired',
        ], 422);
    }
}
}
    }
    else
    return response()->json([
        'message' => 'الكود خطأ  ',
    ], 422);
}
   }

