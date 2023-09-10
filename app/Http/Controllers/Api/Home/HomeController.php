<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get_category_by_id($id){
     $sections=Section::with(['Children'=>function($query){
            $query->with('Children');
         }])->find($id);
        return response()->json([
            'message' =>trans('auth.register.success'),
             'item' => $sections,
        ],200);
}
}
