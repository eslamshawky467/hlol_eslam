<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Service;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\DataTables\CouponsDataTable;
use App\Http\Requests\CouponeRequest;
use App\Repositories\CouponRepository;
use App\Http\Requests\AllCouponsRequest;
use App\Http\Requests\DeleteCouponRequest;

class CouponsController extends Controller
{
    use WebResponce;
    private $couponRepository;
    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index(CouponsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax()->content();
        }
        return view('admin.coupons.index');
    }
    public function ArchivedServices(CouponsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->with('trash', 1)->ajax()->content();
        }
        return view('admin.coupons.trashed');
    }

    public function create()
    {
        $coupon = new Service();
        return view('admin.coupons.create', compact('coupon'));
    }

    public function store(CouponeRequest $request)
    {
        try {
            $this->couponRepository->StoreNew($request);

            return $this->success("تم اضافه الخصم بنجاح", 'coupons.index');
        } catch (\Exception $e) {
            return $this->error("حدث خطا ما يرجى المحاوله لاحقا", "coupons.index");

        }
    }

    public function edit($id)
    {
        $coupon = $this->couponRepository->GetById($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(CouponeRequest $request)
    {
        try {
            $this->couponRepository->Update($request);
            return $this->success("تم التحديث بنجاح", 'coupons.index');

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "coupons.index");

        }
    }
    public function show($id)
    {
        try {
            $coupon = $this->couponRepository->ShowService($id);
            return view('admin.coupons.details', compact('coupon'));

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "coupons.index");

        }

    }
    public function destroy(DeleteCouponRequest $request)
    {
        try {
            $this->couponRepository->Delete($request->id);
            return $this->success("تم حذف  الخصم بنجاح", 'coupons.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "coupons.index");

        }
    }
    public function Restore(DeleteCouponRequest $request)
    {
        try {
            $this->couponRepository->Restore($request->id);
            return $this->success("تم استعاده  الخصم بنجاح", 'coupons.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "coupons.index");

        }
    }
    public function DeleteAll(AllCouponsRequest $request)
    {
        try {
            $this->couponRepository->DeleteAll($request->coupons_ids);
            return $this->success("تم حذف  الخصومات بنجاح", 'coupons.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "coupons.index");

        }
    }
    public function changeStatus($id)
    {
        try {
            $this->couponRepository->ChangeStatus($id);
            return $this->success("تم تغير حاله الخصم بنجاح", 'coupons.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "coupons.index");

        }
    }
    public function ServicesAll(AllCouponsRequest $request)
    {

        try {
            $this->couponRepository->ServicesAll($request);
            return $this->success("تم الحدث بنجاح", 'coupons.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "coupons.index");

        }
    }

    public function SatatusService(CouponsDataTable $dataTable, $status)
    {

        if (request()->ajax()) {
            return $dataTable->with('status', $status)->ajax()->content();
        }
        return view('admin.coupons.status-filter');
    }

}