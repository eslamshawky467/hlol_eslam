<?php

namespace App\Services;

use App\DTO\ServiceDTO;
use App\Interfaces\ServicesInterface;
use App\Models\Service;

class ServiceService implements ServicesInterface
{

    public function CreateDTO($ServiceData)
    {
        return new ServiceDTO(
            $ServiceData->input('id') ?? 0,
            $ServiceData->input('section_id'),
            $ServiceData->input('service_name_ar'),
            $ServiceData->input('service_name_en'),
            $ServiceData->input('status'),
        );

    }
    public function CreateOrUpdate($ServiceData): Service
    {
        $newSrvice = Service::updateOrCreate(
            ['id' => $ServiceData->service_id],
            [
                'section_id' => $ServiceData->section_id,
                'status' => $ServiceData->status,
                'name_ar' => $ServiceData->service_name_ar,
                'name_en' => $ServiceData->service_name_en,
            ]
        );
        return $newSrvice;
    }

    public function FindById($id)
    {
        $service = Service::find($id);

        return $service;
    }

}
