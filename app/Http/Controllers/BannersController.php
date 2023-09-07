<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Traits\WebResponce;
use Illuminate\Http\Request;
use App\DataTables\BannerDataTable;
use App\Http\Requests\BannerRequest;
use App\Repositories\BannerRepository;
use App\Http\Requests\DeleteBannerRequest;
use App\Http\Requests\DeleteAllBannerRequest;

class BannersController extends Controller
{
    use WebResponce;
    private $bannerRepository;
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index(BannerDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax()->content();
        }
        return view('admin.banners.index');
    }

    public function create()
    {
        $banner = new Banner();
        return view('admin.banners.create', compact('banner'));
    }

    public function store(BannerRequest $request)
    {
        try {
            $this->bannerRepository->StoreNew($request);

            return $this->success("تم اضافه اللافته بنجاح", 'banners.index');
        } catch (\Exception $e) {
            return $this->error("حدث خطا ما يرجى المحاوله لاحقا", "banners.index");

        }
    }

    public function edit($id)
    {
        $banner = $this->bannerRepository->GetById($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        try {
            $banner = $this->bannerRepository->Update($request);
            return $this->success("تم التحديث بنجاح", 'banners.index');

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "banners.index");

        }
    }
    public function show($id)
    {
        try {
            $banner = $this->bannerRepository->ShowBanner($id);
            return view('admin.banners.details', compact('banner'));

        } catch (\Exception $e) {
            return $this->error("حدث خطا ما", "banners.index");

        }

    }
    public function destroy(DeleteBannerRequest $request)
    {
        try {
            $this->bannerRepository->Delete($request->id);
            return $this->success("تم حذف  اللافته بنجاح", 'banners.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "banners.index");

        }
    }
    public function DeleteAll(DeleteAllBannerRequest $request)
    {
        try {
            $this->bannerRepository->DeleteAll($request->banners_ids);
            return $this->success("تم حذف  اللافتات بنجاح", 'banners.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "banners.index");

        }
    }
    public function changeStatus($id)
    {
        try {
            $this->bannerRepository->ChangeStatus($id);
            return $this->success("تم تغير حاله اللافته بنجاح", 'banners.index');

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), "banners.index");

        }
    }
    public function BannerAll(DeleteAllBannerRequest $request)
    {

        try {
            $this->bannerRepository->BannerAll($request);
            return $this->success("تم الحدث بنجاح", 'banners.index');

        } catch (\Exception $e) {
            return $this->error('يوجد خطا ما يرجى المحاوله لاحقا', "banners.index");

        }
    }

}
