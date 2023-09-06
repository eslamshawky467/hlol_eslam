<?php

namespace App\Repositories;

use Exception;
use App\Services\FileService;
use App\Interfaces\CRUDInterface;
use App\Services\SettingService;

class SettingRepository implements CRUDInterface
{
    private $settingService;
    private $fileService;

    public function __construct(SettingService $settingService, FileService $fileService)
    {
        $this->settingService = $settingService;
        $this->fileService = $fileService;
    }
    public function GetById($id)
    {
        $setting = $this->settingService->FindById($id);
        if ($setting != null) {
            return $setting;
        }
        throw new Exception("Item NOt FOund");

    }
    public function GetAlls()
    {

    }

    public function StoreNew($SettingData)
    {
        $settingDTOData = $this->settingService->CreateDTO($SettingData);
        $setting = $this->settingService->CreateOrUpdate($settingDTOData);
        return $setting;

    }

    public function Update($SettingData)
    {

        $SettingDTOData = $this->settingService->CreateDTO($SettingData);

        $Setting = $this->settingService->FindById($SettingDTOData->setting_id);

        if ($Setting != null) {
            $updatedSetting = $this->settingService->CreateOrUpdate($SettingDTOData);
            return $updatedSetting;
        }


        throw new Exception("Item NOt FOund");
    }
    public function Delete($id)
    {
        $Setting = $this->settingService->FindById($id);
        if ($Setting != null) {
            return $Setting->delete();
        }
        throw new Exception("Item NOt FOund");
    }
    public function DeleteAll($Data)
    {
        foreach ($Data as $value) {
            $this->Delete($value);
        }
        return true;
    }

}
