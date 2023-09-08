<?php

namespace App\DTO;

class CouponDTO
{

    public $coupon_id;
    public $coupon_name;
    public $coupon_amount;
    public $coupon_type;
    public $coupon_status;
    public $coupon_start_at;
    public $coupon_end_at;

    public function __construct(
        $coupon_id,
        $coupon_name,
        $coupon_amount,
        $coupon_type,
        $coupon_status,
        $coupon_start_at,
        $coupon_end_at
    ) {
        $this->coupon_id = $coupon_id;
        $this->coupon_name = $coupon_name;
        $this->coupon_amount = $coupon_amount;
        $this->coupon_type = $coupon_type;
        $this->coupon_status = $coupon_status;
        $this->coupon_start_at = $coupon_start_at;
        $this->coupon_end_at = $coupon_end_at;
    }
}
