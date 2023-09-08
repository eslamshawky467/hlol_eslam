<?php

namespace App\DTO;

class ServiceDTO
{

    public $service_id;
    public $section_id;
    public $service_name_ar;
    public $service_name_en;
    public $status;

    public function __construct(
        $service_id,
        $section_id,
        $service_name_ar,
        $service_name_en,
        $status
    ) {
        $this->service_id = $service_id;
        $this->section_id = $section_id;
        $this->service_name_ar = $service_name_ar;
        $this->service_name_en = $service_name_en;
        $this->status = $status;
    }
}
