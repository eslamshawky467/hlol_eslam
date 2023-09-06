<?php

namespace App\Services;

use App\DTO\SettingDTO;
use App\Interfaces\ServicesInterface;
use App\Models\Setting;

class SettingService implements ServicesInterface
{

    public function CreateDTO($ClientData)
    {
        return new SettingDTO(
            $ClientData->input('setting_id') ?? 0,
            $ClientData->input('setting_title_ar'),
            $ClientData->input('setting_content_ar'),
            $ClientData->input('setting_title_en'),
            $ClientData->input('setting_content_en'),
            $ClientData->input('type')
        );

    }
    public function CreateOrUpdate($SettingData): Setting
    {
        $newSetting = Setting::updateOrCreate(
            ['id' => $SettingData->setting_id],
            [
                'title_ar' => $SettingData->setting_title_ar,
                'content_ar' => $SettingData->setting_content_ar,
                'title_en' => $SettingData->setting_title_en,
                'content_en' => $SettingData->setting_content_en,
                'type' => $SettingData->type

            ]
        );
        return $newSetting;
    }

    public function FindById($id)
    {
        $Setting = Setting::find($id);

        return $Setting;
    }

}
