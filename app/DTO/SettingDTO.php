<?php

namespace App\DTO;

class SettingDTO
{

    public $setting_id;
    public $setting_title_ar;
    public $setting_content_ar;
    public $setting_title_en;
    public $setting_content_en;
    public $type;

    public function __construct(
        $setting_id,
        $setting_title_ar,
        $setting_content_ar,
        $setting_title_en,
        $setting_content_en,
        $type
    ) {
        $this->setting_id = $setting_id;
        $this->setting_title_en = $setting_title_en;
        $this->setting_title_ar = $setting_title_ar;
        $this->setting_content_ar = $setting_content_ar;
        $this->setting_content_en = $setting_content_en;
        $this->type = $type;

    }
}
