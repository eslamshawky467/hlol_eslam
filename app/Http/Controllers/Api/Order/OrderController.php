<?php

namespace App\Http\Controllers\Api\Order;
use App\Models\Cost;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\Location;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Used_Coupoun;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function make_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location_id' => 'required',
            'date' => 'required',
            'payment_method' => 'required',
            'items' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }
        if($request->coupon != null) {
            $coupoun = Coupon::where('name', $request->coupon)->first();
            $order = Order::create([
            'client_id' => auth('client')->user()->id,
            'cost' => 0,
            'location_id' => $request->location_id,
            'date' => $request->date,
            'payment_method' => $request->payment_method,
            'coupon' => $coupoun->amount,
            'status'=>'pending',
            ]);
        $coupon_id=$coupoun->id;
        Used_Coupoun::create([
            'client_id' => auth('client')->user()->id,
            'coupon_id'=>$coupon_id,
           ]);
            $this->get_section($order->id, $request->items, $request->location_id, $request->date, $request->payment_method);
if($request->payment_method == 'cash') {
    return $this->response_cash();
}
else{
    return  $this->response_visa();
}

        } else {
            $order = Order::create([
            'client_id' => auth('client')->user()->id,
            'cost' => 0,
            'location_id' => $request->location_id,
            'date' => $request->date,
            'payment_method' => $request->payment_method,
            'coupon' => 0,
            'status'=>'pending',
            ]);
            $this->get_section($order->id, $request->items, $request->location_id, $request->date, $request->payment_method);
            if($request->payment_method == 'cash') {
            return     $this->response_cash();
            }
            else{
                return  $this->response_visa();
            }
        }
    }
    public function get_section($id, $items, $location, $date, $payment)
    {
        foreach ($items as $item) {
            $section = Section::where('id', $item['id'])->first();
            $parent = $section->parent_id;
            $children = $item['children'];
            if(empty($children)) {
                $order = OrderDetail::create([
                    'client_id' => auth('client')->user()->id,
                    'cost' => 0,
                    'location_id' => $location,
                    'date' => $date,
                    'payment_method' => $payment,
                    'price' => 0,
                    'order_id' => $id,
                    'parent_id' => $parent,
                    'children_id' => null,
                    'section_id' => $item['id'],
                    'quantity' => 0 ,
                    'status'=>'pending',
                    'unit_price'=>0,
                    ]);
            } else {
                foreach ($children as $child) {
                    $section = Section::where('id', $item['id'])->first();
                    $parent = $section->parent_id;
                    $ids = $child['id'];
                    $ch = Section::where('id', $child['id'])->first();
                    $price = $child['count'] * $ch->price;
                    $order = OrderDetail::create([
                        'client_id' => auth('client')->user()->id,
                        'cost' => 0,
                        'location_id' => $location,
                        'date' => $date,
                        'payment_method' => $payment,
                        'price' => $price,
                        'order_id' => $id,
                        'parent_id' => $parent,
                        'children_id' => $child['id'],
                        'section_id' => $item['id'],
                        'quantity' => $child['count'],
                        'status'=>'pending',
                        'unit_price'=>$ch->price,
                        ]);
                }

            }
        }
        $this->finsish_order($id, $payment);
    }
    public function finsish_order($id , $payment)
    {
        $cost=Cost::where('id',1)->first();
        $tax=$cost->tax;
        $delivery=$cost->delivery;
       $get=Order::where('id',$id)->first();
       $coupon=$get->coupon;
        $total_price = OrderDetail::where('order_id', $id)->sum('price');
        $total=$total_price+ $tax + $delivery - $coupon;
        OrderDetail::where('order_id', $id)->update([
            'cost' => $total_price,
        ]);
        Order::where('id', $id)->update([
        'cost' => $total_price,
        'total_price'=>$total,
        ]);
    }
    public function response_cash(){
        return response()->json([
            'message' => 'success',
            'item' => null,
        ], 200);
    }
    public function response_visa(){
        return response()->json([
            'message' => 'success',
            'item' => "www.google.com",
        ], 200);
    }


    public function order_list(Request $request){
        $order = Order::where('client_id',auth('client')->user()->id)->
            when($request->has('status'), function ($query) use ($request) {
                $query->where('order_status', $request->status);
            })
            ->when($request->has('date'), function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            })->get();


           $items=$order->map(function ($order){
            $order_detail=OrderDetail::where('order_id',$order->id)->get(['parent_id']);
           $items = Section::whereIn('id',$order_detail)->get();
            $order['items']=$items;
            return $order;
        });
        if (!$order) {
            return response()->json([
                'message' => 'Success',
                'items'=>$order,
            ], 200);
        }
        return response()->json([
            'message' => 'Success',
            'items' => $order,
        ], 200);
}



public function get_order_by_id($id){

    //$order_detail = OrderDetail::where('id',23)->first();
    //$section=Section::where('id',$order_detail)->first();
    //return $order_detail->load('item');


   // $order_detail = OrderDetail::where('order_id',$id)->with(['item'=>function($query){
     //   $query->with(['children'=>function($query){
      //  $query->with('children');
   // }]);
   // }])->get();
$order_detail = OrderDetail::where('order_id',$id)->get();
$orders = $order_detail->map(function ($item) {
    $parent = Section::where('id',$item->parent_id)->get();
      $child=$parent->map(function ($parent_item) use($item) {
        $parent = Section::where('id',$item->section_id)->get();
        $service=$parent->map(function ($child_item) use($item) {
            $services = Section::where('id',$item->children_id)->get();
            $child_item['children']=$services;
            return $child_item;
        });
        $parent_item['children'] = $parent;
        return $parent_item;
    });
    return $item['items']=$child;
   //return array_push($item,['items'=>$child]);
});
$order=Order::where('id',$id)->first();
$order['items'] =$order_detail;
$location_id=$order->location_id;
$location=Location::where('id',$location_id)->first();
$cost=Cost::where('id',1)->first();
$tax=$cost->tax;
$delivery=$cost->delivery;
$order['location']=$location;
$order['tax']=$tax;
$order['delivery']=$delivery;
if (!$order) {
    return response()->json([
        'message' => 'Success',
        'items'=>$order,
    ], 200);
}
return response()->json([
    'message' => 'Success',
     'item'=>$order
], 200);
}
public function create_order_fees(){
$cost=Cost::first();
return response()->json([
    'message' => 'Success',
     'item'=>$cost
], 200);
}



/*
public function get_order_by_id($id){
    $order = OrderDetail::where('order_id',$id)->with(['item'=>function($query){
        $query->with(['children'=>function($query){
        $query->with('children');
    }]);
    }])->get();
    $order_detail=Order::where('id',$id)->first();
    $location_id=$order_detail->location_id;
    $location=Location::where('id',$location_id)->first();
    $cost=Cost::where('id',1)->first();
    $tax=$cost->tax;
    $delivery=$cost->delivery;
    if (!$order) {
        return response()->json([
            'message' => 'Success',
            'items'=>$order,
        ], 200);
    }
    return response()->json([
        'message' => 'Success',
         'item'=>$order
        ,'location'=>$location,
        'date'=>$order_detail->date,
        'total_price'=>$order_detail->total_price,
        'payment_method'=>$order_detail->payment_method,
        'tax'=>$tax,
        'discount'=>$order_detail->coupon,
        'delivery'=>$delivery,
        'pure_price'=>$order_detail->cost,
        'created_at'=>$order_detail->created_at,
    ], 200);
    }
    }
*/








}
