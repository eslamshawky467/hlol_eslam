<?php

namespace App\Repositories;

use Exception;
use App\Services\FileService;
use App\Services\BannerService;
use App\Services\ServiceService;
use App\Interfaces\CRUDInterface;
use App\Interfaces\CustomInterface;
use App\Interfaces\ServiceSectionInterface;
use App\Models\Service;

class ServiceRepository implements CRUDInterface, CustomInterface, ServiceSectionInterface
{
    private $serviceService;
    private $fileService;

    public function __construct(ServiceService $serviceService, FileService $fileService)
    {
        $this->serviceService = $serviceService;
        $this->fileService = $fileService;
    }
    public function GetById($id)
    {
        $service = $this->serviceService->FindById($id);
        if ($service != null) {
            return $service;
        }
        throw new Exception("Item NOt FOund");

    }
    public function GetAlls()
    {

    }

    public function StoreNew($ServiceData)
    {
        $serviceDTOData = $this->serviceService->CreateDTO($ServiceData);


        $servic = $this->serviceService->CreateOrUpdate($serviceDTOData);

        if ($ServiceData->hasFile('service_image')) {

            $this->fileService->CreateFile($ServiceData->file('service_image'), $servic, 'services', $servic->name_en);

        }
        return $servic;

    }

    public function Update($ServiceData)
    {

        $ServiceDTOData = $this->serviceService->CreateDTO($ServiceData);

        $Service = $this->serviceService->FindById($ServiceDTOData->service_id);

        if ($Service != null) {
            $updatedService = $this->serviceService->CreateOrUpdate($ServiceDTOData);

            if ($ServiceData->hasFile('service_image')) {
                $this->fileService->DeleteFile($updatedService, 'uploads/services/' . $Service->name_en);
                $this->fileService->CreateFile($ServiceData->file('service_image'), $updatedService, 'services', $updatedService->name_en);
            }
            return $updatedService;
        }


        throw new Exception("Item NOt FOund");
    }
    public function Delete($id)
    {
        $service = $this->serviceService->FindById($id);
        if ($service != null) {
            $service->delete();
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
        $Service = $this->serviceService->FindById($id);
        if ($Service != null) {
            $this->fileService->DeleteFile($Service, 'uploads/services/' . $Service->name_en);
            return $Service->forceDelete();
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
        $service = $this->serviceService->FindById($id);
        if ($service != null) {
            if ($service->status == 0)
                $service->status = 1;
            else {
                $service->status = 0;

            }
            $service->save();
            return $service;
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
        $service = $this->serviceService->FindById($id);
        if ($service != null) {
            $service->load('file');
            return $service;
        }
        throw new Exception("Item NOt FOund");

    }

    public function ServicesAll($Data)
    {
        if ($Data->action == 'delete') {
            $this->DeleteAll($Data->services_ids);
        }
        if ($Data->action == 'status') {
            $this->ChangeStatusAll($Data->services_ids);
        }
        if ($Data->action == 'force-delete') {
            $this->ForceDeleteAll($Data->services_ids);
        }
        if ($Data->action == 'restore') {
            $this->RestoreAll($Data->services_ids);
        }
    }


    public function Restore($id)
    {

        $Section = Service::withTrashed()
            ->where('id', $id)
            ->first();
        if ($Section != null) {
            return $Section->restore();
        }
        throw new Exception("Item NOt FOund");
    }
    public function RestoreAll($ids)
    {
        return Service::withTrashed()
            ->whereIn('id', $ids)
            ->restore();
    }
    public function ArchiveAll($Data)
    {

    }

}
