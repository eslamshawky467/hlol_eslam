<?php

namespace App\Repositories;

use Exception;
use App\DTO\SectionDTO;
use App\Models\Section;
use App\Enums\MessagesEnum;
use App\Services\FileService;
use App\Services\SectionService;
use App\Interfaces\CRUDInterface;
use App\Interfaces\CustomInterface;

class SectionRepository implements CRUDInterface, CustomInterface
{
    private $sectionService;
    private $fileService;

    public function __construct(SectionService $sectionService, FileService $fileService)
    {
        $this->sectionService = $sectionService;
        $this->fileService = $fileService;
    }
    public function GetById($id)
    {
        $Section = $this->sectionService->FindById($id);
        if ($Section != null) {
            return $Section;
        }
        throw new Exception("Item NOt FOund");

    }
    public function GetAlls()
    {

    }

    public function StoreNew($SectionData)
    {
        $sectionData = $this->sectionService->CreateDTO($SectionData);


        $section = $this->sectionService->CreateOrUpdate($sectionData);

        if ($SectionData->hasFile('section_image')) {

            $this->fileService->CreateFile($SectionData->file('section_image'), $section, 'sections', $section->translate('en')->section_name);

        }
        return $section;

    }

    public function Update($SectionData)
    {

        $sectionData = $this->sectionService->CreateDTO($SectionData);

        $Section = $this->sectionService->FindById($sectionData->section_id);

        if ($Section != null) {
            $section = $this->sectionService->CreateOrUpdate($sectionData);

            if ($SectionData->hasFile('section_image')) {
                $this->fileService->DeleteFile($section, 'uploads/sections/' . $Section->translate('en')->section_name);
                $this->fileService->CreateFile($SectionData->file('section_image'), $section, 'sections', $section->translate('en')->section_name);
            }
            return $section;
        }


        throw new Exception("Item NOt FOund");
    }

    public function Delete(int $id)
    {
        $Section = $this->sectionService->FindById($id);
        if ($Section != null) {
            return $Section->delete();
        }
        throw new Exception("Item NOt FOund");

    }

    public function DeleteAll($Data)
    {
        return Section::whereIn('id', $Data)->forceDelete();

    }
    public function ArchiveAll($Data)
    {
        return Section::whereIn('id', $Data)->delete();

    }
    public function ForeverDelete($id)
    {
        $Section = $this->sectionService->FindById($id);
        if ($Section != null) {
            return $Section->forceDelete();
        }
        throw new Exception("Item NOt FOund");
    }
    public function Restore($id)
    {

        $Section = Section::withTrashed()
            ->where('id', $id)
            ->first();
        if ($Section != null) {
            return $Section->restore();
        }
        throw new Exception("Item NOt FOund");
    }
    public function RestoreAll($ids)
    {
        return Section::withTrashed()
            ->whereIn('id', $ids)
            ->restore();
    }

}
