<?php

namespace App\DTO;

class BannerDTO
{

    public $banner_id;
    public $banner_name;
    public $status;

    public function __construct(
        $banner_id,
        $banner_name,
        $status
    ) {
        $this->banner_id = $banner_id;
        $this->banner_name = $banner_name;
        $this->status = $status;
    }
}