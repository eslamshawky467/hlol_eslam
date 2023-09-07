<?php

namespace App\Services;

use App\DTO\BannerDTO;
use App\Interfaces\ServicesInterface;
use App\Models\Banner;

class BannerService implements ServicesInterface
{

    public function CreateDTO($BannerData)
    {
        return new BannerDTO(
            $BannerData->input('id') ?? 0,
            $BannerData->input('banner_name'),
            $BannerData->input('status'),
        );

    }
    public function CreateOrUpdate($BannerData): Banner
    {
        $newBanner = Banner::updateOrCreate(
            ['id' => $BannerData->banner_id],
            [
                'status' => $BannerData->status,
                'name' => $BannerData->banner_name,
            ]
        );
        return $newBanner;
    }

    public function FindById($id)
    {
        $banner = Banner::find($id);

        return $banner;
    }

}
