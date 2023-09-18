<?php

use App\Http\Controllers\Api\Home\HomeController;
use App\Http\Controllers\Api\Order\CoupounController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Auth\ClientAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth', 'middleware' =>['checklang','json'] ], function () {
    Route::get('items-by-category/{id}', [HomeController::class, 'get_category_by_id']);
    Route::get('home', [HomeController::class, 'home']);
    Route::get('get-onboarding', [HomeController::class,'get_onboarding']);
    Route::post('home-search', [HomeController::class,'home_search']);
});
Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'middleware' =>['checklang','json'] ], function () {
        Route::post('login', [ClientAuthController::class, 'login']);
    });
Route::group(['namespace' => 'Auth', 'prefix' => 'auth/user', 'middleware' =>['checklang','auth:client','active','json'] ], function () {
        Route::post('register', [ClientAuthController::class, 'register']);
        Route::post('me', [ClientAuthController::class, 'me']);
        Route::post('logout', [ClientAuthController::class, 'logout']);
        Route::post('deleteAccount', [ClientAuthController::class,'delete_account']);
        Route::post('updateProfile', [ClientAuthController::class,'update_profile']);
    });

    Route::group(['namespace' => 'Auth', 'prefix' => 'auth/user/locations', 'middleware' =>['checklang','auth:client','active','json'] ], function () {
        Route::post('storeLocation', [ClientAuthController::class, 'store_location']);
        Route::post('updateLocation', [ClientAuthController::class, 'update_location']);
        Route::get('allLocation', [ClientAuthController::class, 'get_all_locations']);
        Route::post('deleteLocation', [ClientAuthController::class,'remove_location']);
    });

    Route::group(['namespace' => 'Auth', 'middleware' =>['checklang','auth:client','active','json'] ], function () {
        Route::get('get-coupon-value/{code}', [CoupounController::class, 'get_coupoun']);
    });

    Route::group(['namespace' => 'Auth', 'middleware' =>['checklang','auth:client','active','json'] ], function () {
        Route::post('create-order', [OrderController::class,'make_order']);
        Route::post('orders-list', [OrderController::class,'order_list']);
        Route::get('order-details/{id}', [OrderController::class,'get_order_by_id']);
        Route::get('create-order-fees', [OrderController::class,'create_order_fees']);
    });
