<?php

use App\Http\Controllers\Api\Home\HomeController;
use App\Http\Controllers\Auth\ClientAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
        Route::get('Home/{id}', [HomeController::class, 'get_category_by_id']);

    });
