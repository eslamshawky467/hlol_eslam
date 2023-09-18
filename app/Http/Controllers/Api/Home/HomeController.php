<?php

namespace App\Http\Controllers\Api\Home;
use App\Models\Banner;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\SectionTranslation;

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


public function get_onboarding(){
    $board=Board::select('id','description_'.app()->getLocale() .' as description')->get();
       return response()->json([
           'message' =>"success",
            'items' =>$board,
       ],200);
}


public function home_search(Request $request){
    $query= SectionTranslation::where('section_name','LIKE', '%'.$request->queries.'%')->select('section_name','section_id')->get();
    $queries = $query->map(function ($query) {
        $image=Section::where('id',$query->section_id)->first()->image;
        $id=Section::where('id',$query->section_id)->first()->id;
        $query['image']=$image;
        $query['id']=$id;
        return $query;
    });
    return response()->json([
           'message' =>"success",
            'items' =>$query,
       ],200);
}



}
