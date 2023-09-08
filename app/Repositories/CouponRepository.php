<?php

namespace App\Repositories;

use App\Models\Coupon;
use Exception;
use App\Services\FileService;
use App\Services\BannerService;
use App\Services\ServiceService;
use App\Interfaces\CRUDInterface;
use App\Interfaces\CustomInterface;
use App\Interfaces\ServiceSectionInterface;
use App\Models\Service;
use App\Services\CouponService;

class CouponRepository implements CRUDInterface, CustomInterface, ServiceSectionInterface
{
    private $couponService;
    private $fileService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    public function GetById($id)
    {
        $coupon = $this->couponService->FindById($id);
        if ($coupon != null) {
            return $coupon;
        }
        throw new Exception("Item NOt FOund");

    }
    public function GetAlls()
    {

    }

    public function StoreNew($CouponData)
    {
        $couponDTOData = $this->couponService->CreateDTO($CouponData);


        $coupon = $this->couponService->CreateOrUpdate($couponDTOData);

        return $coupon;

    }

    public function Update($CouponData)
    {

        $CouponDTOData = $this->couponService->CreateDTO($CouponData);

        $Coupon = $this->couponService->FindById($CouponDTOData->coupon_id);

        if ($Coupon != null) {
            $updatedCoupon = $this->couponService->CreateOrUpdate($CouponDTOData);
            return $updatedCoupon;
        }


        throw new Exception("Item NOt FOund");
    }
    public function Delete($id)
    {
        $coupon = $this->couponService->FindById($id);
        if ($coupon != null) {
            $coupon->delete();
        }

    }

    public function DeleteAll($Data)
    {
        foreach ($Data as $value) {
            $this->Delete($value);
        }
        return true;
    }
    public function ForeverDelete($id)
    {
        $Coupon = $this->couponService->FindById($id);
        if ($Coupon != null) {
            return $Coupon->forceDelete();
        }
        throw new Exception("Item NOt FOund");
    }

    public function ForceDeleteAll($Data)
    {
        foreach ($Data as $value) {
            $this->ForeverDelete($value);
        }
        return true;
    }

    public function ChangeStatus(int $id)
    {
        $coupon = $this->couponService->FindById($id);
        if ($coupon != null) {
            if ($coupon->status == 0)
                $coupon->status = 1;
            else {
                $coupon->status = 0;

            }
            $coupon->save();
            return $coupon;
        }
        throw new Exception("Item NOt FOund");

    }
    public function ChangeStatusAll($Data)
    {
        foreach ($Data as $value) {
            $this->ChangeStatus($value);
        }
        return true;
    }
    public function ShowService($id)
    {
        $coupon = $this->couponService->FindById($id);
        if ($coupon != null) {
            return $coupon;
        }
        throw new Exception("Item NOt FOund");

    }

    public function ServicesAll($Data)
    {
        if ($Data->action == 'delete') {
            $this->DeleteAll($Data->coupons_ids);
        }
        if ($Data->action == 'status') {
            $this->ChangeStatusAll($Data->coupons_ids);
        }
        if ($Data->action == 'force-delete') {
            $this->ForceDeleteAll($Data->coupons_ids);
        }
        if ($Data->action == 'restore') {
            $this->RestoreAll($Data->coupons_ids);
        }
    }


    public function Restore($id)
    {

        $Coupon = Coupon::withTrashed()
            ->where('id', $id)
            ->first();
        if ($Coupon != null) {
            return $Coupon->restore();
        }
        throw new Exception("Item NOt FOund");
    }
    public function RestoreAll($ids)
    {
        return Coupon::withTrashed()
            ->whereIn('id', $ids)
            ->restore();
    }
    public function ArchiveAll($Data)
    {

    }

}