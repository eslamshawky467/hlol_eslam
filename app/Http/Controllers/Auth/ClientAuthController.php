<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\Location;

class ClientAuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
                'name'=> 'required|string',
                'email' =>'email|unique:clients',
                'image'=>'image',
                'gender'=>'required',
                'long'=>'required',
                'lat' => 'required',
                'location'=>' required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first()],422);
        }
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images/profile'), $filename);
            $image_file = $request->file('image')->getClientOriginalName();
        $user = Client::where('id',auth('client')->user()->id)->update([
            'image'=>"https://hlol.api.app.co.hlol.co/public/images/profile/$image_file",
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'is_registered'=>1,
            'status'=>'active',
        ]);
         Location::create([
            'lat'=>$request->lat,
            'long'=>$request->long,
            'location'=>$request->location,
            'client_id'=>auth('client')->user()->id
        ]);
        return response()->json([
            'message' =>trans('auth.register.success'),
             'item' => Client::where('id',auth('client')->user()->id)->with('location')->first(),
        ], 200);
        }
        else
        $user = Client::where('id',auth('client')->user()->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'is_registered'=>1,
            'status'=>'active',
        ]);
        Location::create([
            'lat'=>$request->lat,
            'long'=>$request->long,
            'location'=>$request->location,
            'client_id'=>auth('client')->user()->id
        ]);
        return response()->json([
            'message' =>trans('auth.register.success'),
            'item'=> Client::where('id',auth('client')->user()->id)->with('location')->first(),
        ],200);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'phone_number' => 'required|numeric',
        ] ,[
            'phone_number.required'=>trans('auth.phonenumber.register'),
            'phone_number.numeric'=>trans('auth.phonenumber.numeric')
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first()],422);
        }
        if (Client::where('phone_number',$request->phone_number)->exists()){
            $provider=Client::where('phone_number', $request->phone_number)->first();
            $status=$provider->status;
            if($status=='inactive') {
                return response()->json(['message' =>trans('admin.unoooooo'),
            ],401);
            }
            else{
                $token= auth()->guard('client')->login($provider);
                Client::where('phone_number', $request->phone_number)->update([
                    'device_token'=>$request->device_token,
                    'is_registered'=>0
                ]);
                return $this->respondWithToken($token);
}
        }else{
          $client=Client::create(array_merge(
                $validator->validated(),
                ['phone_number'=>$request->phone_number],
                ['status'=>'active'],
                ['device_token'=> $request->device_token],
                ['is_registered'=> 0],
                ['country_code'=>$request->country_code],
            ));
            $token= auth()->guard('client')->login($client);
            return $this->respondWithToken($token);
        }
    }


    protected function respondWithToken($token)
    {
        $name=Client::where('id',auth('client')->user()->id)->first()->name;
        if($name != null){
        return response()->json([
            'message'=>'success',
            'item' =>
            [
            'user' =>Client::where('id',auth('client')->user()->id)->with('location')->first(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'is_registered'=>true
            ],
        ],200);
        }
        else
        return response()->json([
            'message'=>'success',
           'item' =>
           [
            'user' =>Client::where('id',auth('client')->user()->id)->with('location')->first(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'is_registered'=>false
            ],
        ],200);
    }




    public function logout()
    {
        auth('client')->logout();
        return response()->json([
            'message' =>trans('auth.logout.success')]
        ,200
        );
    }



    public function me()
    {
        return response()->json([
            'message' => 'Success',
            'item'=>['user'=>Client::where('id',auth('client')->user()->id)->with('location')->first()]
        ], 200);
    }



    public function update_profile(Request $request){
    $validator = Validator::make($request->all(), [
        'name'=>'required|string',
         'email' => 'email|unique:clients,email,' .auth('client')->user()->id,
         'phone_number'=>' required|numeric|unique:clients,phone_number,'.auth('client')->user()->id,
         'image'=>'image',
     ], [
    'email.unique'=>trans('auth.email.unique.register'),
    'name.required'=>trans('auth.nameRegister'),
    'name.string'=>trans('auth.string.register'),
    'email.email'=>trans('auth.email.email.register'),
    'address.required'=>trans('auth.address'),
     ]);
    if ($validator->fails()) {
        return response()->json(['message'=>$validator->errors()->first()],422);
    }
    $user=$request->user();
    $image_file = $user->image;
if($request->hasFile('image')) {
    $image = $request->file('image');
    $filename = $image->getClientOriginalName();
    $image->move(public_path('images/profile'), $filename);
    $image_file = $request->file('image')->getClientOriginalName();
    $user->update([
        'image'=>"https://hlol.api.app.co.hlol.co/public/images/profile/$image_file",
        'name'=>$request->name,
        'email'=>$request->email,
        'phone_number'=>$request->phone_number,
        'gender'=>$request->gender
    ]);
    return response()->json([
        'message'=>trans('msg.updateSuccess'),
    ],200);
}else
$user->update([
    'name'=>$request->name,
    'email'=>$request->email,
    'phone_number'=>$request->phone_number,
    'gender'=>$request->gender
]);
return response()->json([
    'message'=>trans('msg.updateSuccess'),
],200);
    }
    public function delete_account(){
        Client::where('id',auth('client')->user()->id)->update([
            'status'=>'inactive',
            ]);
            return response()->json([
             'message'=>'Deleted Successfully',
      ],200);
    }




public function store_location(Request $request){
    $validator = Validator::make($request->all(), [
        'long'=>'required',
        'lat' => 'required',
        'location'=>' required',
     ],[
    'locations.required'=>trans('auth.locationrequired'),
     ]);
    if ($validator->fails()) {
        return response()->json(['message'=>$validator->errors()->first()],422);
    }
    $location = Location::create([
        'client_id' => auth('client')->user()->id,
        'lat' => $request->lat,
        'long' => $request->long,
        'location' => $request->location,
         ]);
return response()->json([
    'message'=>'Successfully',
    'items'=>$request->location,
],200);
}
public function update_location(Request $request){
    $validator = Validator::make($request->all(), [
         'long'=>'required',
         'lat' => 'required',
         'location'=>' required',
     ],[
    'lat.required'=>trans('auth.latrequired'),
    'long.required'=>trans('auth.longrequired'),
    'location.required'=>trans('auth.locationrequired'),
     ]);
    if ($validator->fails()) {
        return response()->json(['message'=>$validator->errors()->first()],422);
    }
    $location = Location::where('id', $request->id)->update([
        'lat' => $request->lat,
        'long' => $request->long,
        'location' => $request->location,
         ]);

return response()->json([
    'message'=>'Successfully',
],200);
}
public function get_all_locations(){

    $location = Location::where('client_id',auth('client')->user()->id)->get();
    return response()->json([
        'message'=>'Successfully',
        'items'=>$location,
    ],200);
}

public function remove_location(Request $request){
      Location::where('id',$request->id)->delete();
    return response()->json([
        'message'=>'Successfully',
    ],200);
}
}
