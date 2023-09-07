<?php

namespace App\Repositories;

use Exception;
use App\Services\FileService;
use App\Services\BannerService;
use App\Interfaces\CRUDInterface;
use App\Interfaces\BannerInterface;

class BannerRepository implements CRUDInterface, BannerInterface
{
    private $bannerService;
    private $fileService;

    public function __construct(BannerService $bannerService, FileService $fileService)
    {
        $this->bannerService = $bannerService;
        $this->fileService = $fileService;
    }
    public function GetById($id)
    {
        $banner = $this->bannerService->FindById($id);
        if ($banner != null) {
            return $banner;
        }
        throw new Exception("Item NOt FOund");

    }
    public function GetAlls()
    {

    }

    public function StoreNew($BannerData)
    {
        $bannerDTOData = $this->bannerService->CreateDTO($BannerData);


        $banner = $this->bannerService->CreateOrUpdate($bannerDTOData);

        if ($BannerData->hasFile('banner_image')) {

            $this->fileService->CreateFile($BannerData->file('banner_image'), $banner, 'banners', $banner->name);

        }
        return $banner;

    }

    public function Update($BannerData)
    {

        $BannerDTOData = $this->bannerService->CreateDTO($BannerData);

        $Banner = $this->bannerService->FindById($BannerDTOData->banner_id);

        if ($Banner != null) {
            $updatedBanner = $this->bannerService->CreateOrUpdate($BannerDTOData);

            if ($BannerData->hasFile('banner_image')) {
                $this->fileService->DeleteFile($updatedBanner, 'uploads/banners/' . $Banner->name);
                $this->fileService->CreateFile($BannerData->file('banner_image'), $updatedBanner, 'banners', $updatedBanner->name);
            }
            return $updatedBanner;
        }


        throw new Exception("Item NOt FOund");
    }
    public function Delete($id)
    {
        $banner = $this->bannerService->FindById($id);
        if ($banner != null) {
            $this->fileService->DeleteFile($banner, 'uploads/banners/' . $banner->name);
            $banner->delete();
        }

    }

    public function DeleteAll($Data)
    {
        foreach ($Data as $value) {
            $this->Delete($value);
        }
        return true;
    }


    public function ChangeStatus(int $id)
    {
        $client = $this->bannerService->FindById($id);
        if ($client != null) {
            if ($client->status == 0)
                $client->status = 1;
            else {
                $client->status = 0;

            }
            $client->save();
            return $client;
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
    public function ShowBanner($id)
    {
        $banner = $this->bannerService->FindById($id);
        if ($banner != null) {
            $banner->load('file');
            return $banner;
        }
        throw new Exception("Item NOt FOund");

    }

    public function BannerAll($Data)
    {
        if ($Data->action == 'delete') {
            $this->DeleteAll($Data->banners_ids);
        }
        if ($Data->action == 'status') {
            $this->ChangeStatusAll($Data->banners_ids);
        }
    }

}
