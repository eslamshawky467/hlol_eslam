<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;

class SectionDTO
{

    public $section_id;
    public $section_name_ar;
    public $section_name_en;
    public $parent_id;
    public $active;

    public function __construct($section_id, $section_name_ar, $section_name_en, $parent_id, $active)
    {
        $this->section_id = $section_id;
        $this->parent_id = $parent_id;
        $this->section_name_ar = $section_name_ar;
        $this->section_name_en = $section_name_en;
        $this->active = $active;
    }
}
