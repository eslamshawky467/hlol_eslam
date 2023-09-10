<?php

namespace App\Http\Controllers\Api\Home;

use App\Models\Banner;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function get_category_by_id($id){
     $sections=Section::where('active','1')->with(['Children'=>function($query){
            $query->with('Children');
         }])->find($id);
        return response()->json([
            'message' =>trans('auth.register.success'),
             'item' => $sections,
        ],200);
}
public function home(){
    $sections=Section::where('parent_id',null)->where('active','1')->get();
    $banners=Banner::all();
       return response()->json([
           'message' =>trans('auth.register.success'),
            'item' =>
            [
              'services'=>$sections,
               'ads'=>$banners,
            ]
       ],200);
}
}
