<?php

namespace App\Services;

use App\DTO\CouponDTO;
use App\Interfaces\ServicesInterface;
use App\Models\Banner;
use App\Models\Coupon;

class CouponService implements ServicesInterface
{

    public function CreateDTO($CouponData)
    {
        return new CouponDTO(
            $CouponData->input('id') ?? 0,
            $CouponData->input('coupon_name'),
            $CouponData->input('coupon_amount'),
            $CouponData->input('coupon_type'),
            $CouponData->input('coupon_status'),
            $CouponData->input('coupon_start_at'),
            $CouponData->input('coupon_end_at')
        );

    }
    public function CreateOrUpdate($CouponData): Coupon
    {
        $newBanner = Coupon::updateOrCreate(
            ['id' => $CouponData->coupon_id],
            [
                'name' => $CouponData->coupon_name,
                'amount' => $CouponData->coupon_amount,
                'type' => $CouponData->coupon_type,
                'status' => $CouponData->coupon_status,
                'start_at' => $CouponData->coupon_start_at,
                'end_at' => $CouponData->coupon_end_at,
            ]
        );
        return $newBanner;
    }

    public function FindById($id)
    {
        $coupon = Coupon::find($id);

        return $coupon;
    }

}
