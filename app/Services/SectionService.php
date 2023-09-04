<?php

namespace App\Services;

use App\DTO\SectionDTO;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ServicesInterface;

class SectionService implements ServicesInterface
{

    public function CreateDTO($SectionData)
    {
        return new SectionDTO(
            $SectionData->input('id') ?? 0,
            $SectionData->input('section_name_ar'),
            $SectionData->input('section_name_en'),
            $SectionData->input('parent_id'),
            $SectionData->input('active'),
        );

    }
    public function CreateOrUpdate($SectionData): Section
    {
        $newSection = Section::updateOrCreate(
            ['id' => $SectionData->section_id],
            [
                'parent_id' => $SectionData->parent_id,
                'active' => $SectionData->active,
                'ar' => ['section_name' => $SectionData->section_name_ar],
                'en' => ['section_name' => $SectionData->section_name_en],
            ]
        );
        return $newSection;
    }

    public function FindById($id)
    {
        $section = Section::find($id);

        return $section;
    }

}
